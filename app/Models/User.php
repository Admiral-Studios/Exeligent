<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Cashier;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Models\Activity;


/**
 * This is the model class for table "users"
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $google_id
 * @property int|null $country_id
 * @property string|null $city
 * @property string|null $age
 * @property string|null $company
 * @property string|null $position
 * @property string|null $industry
 * @property string|null $work_since
 * @property Carbon $created_at
 * @property Carbon $email_verified_at
 * @property boolean|null $is_wanna_test
 *
 * @property Country|null $country
 *
 * @property Subscription|null $activeSubscription
 * @property PlanPrice|null $currentPlanPrice
 * @property Plan|null $currentPlan
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable, SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_TEST = 3;

    const ALL_ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_USER => 'Customer',
        self::ROLE_TEST => 'Testing'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'email_verified_at',
        'first_name',
        'last_name',
        'email',
        'google_id',
        'password',
        'country_id',
        'city',
        'age',
        'company',
        'position',
        'industry',
        'work_since',
        'is_used_trial',
        'suspended_at',
        'pm_type',
        'pm_last_four',
        'pm_cardholder_name',
        'pm_billing_address',
        'is_registration_confirmed',
        'plan_id',
        'stripe_payment_intent_id',
        'voucher_id',
        'voucher_expire_at',
        'is_guide_seen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'password' => 'hashed',
        'voucher_expire_at' => 'date',
        'is_guide_seen' => 'bool'
    ];


    protected static function booted () {

        static::created(function (User $user) {
            if ($user->isAdmin() || $user->isTest()) {
                $user->is_wanna_test = false;
                $user->update();
            }
        });

//        static::deleting(function(User $user) {
//            if ($user->stripe_id)
//                $user->asStripeCustomer()->delete();
//
//            $user->contacts()->delete();
//            $user->subscriptions()->delete();
//            $user->activity()->delete();
//            $user->forms()->delete();
//        });

    }



    /** \/ Scopes \/ */
    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at')
                ->whereNull('suspended_at');
    }

    public function scopeLead($query)
    {
        return $query->whereNull('role_id');
    }

    public function scopeHasRole($query)
    {
        return $query->whereNotNull('role_id');
    }
    /** /\ End Scopes /\ */


    /** \/ Relations \/ */
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function forms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserForm::class);
    }

    public function subscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subscription::class)
            ->orderBy('id', 'DESC');
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->whereIn('stripe_status', ['active', 'trialing']);
    }

    public function currentPlanPrice(): HasOneThrough|HasOne
    {
        if ($this->hasOneTimePaid()) {
            return $this->currentPlan?->chargePrice();
        } else {
            return $this->hasOneThrough(
                PlanPrice::class, Subscription::class,
                'user_id', 'stripe_price_id',
                'id', 'stripe_price')
                ->whereIn('subscriptions.stripe_status', ['active', 'trialing']);
        }
    }

    public function currentPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        if ($this->hasOneTimePaid()) {
            return $this->belongsTo(Plan::class, 'plan_id', 'id');
        } else {
            return $this->currentPlanPrice->plan();
        }
    }

    public function activity(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Activity::class, 'causer');
    }

    public function latestActivity(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->activity()
            ->take(30)
            ->latest();
    }

    public function networkingPreparation()
    {
        return $this->hasOne(UserNetworkingPreparation::class);
    }
    /** /\ End Relations /\ */


    /** \/ Custom \/ */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPrettyCreatedAtAttribute(): ?string
    {
        return $this->created_at?->format('H:i d.m.Y');
    }

    public function isAdmin(): bool
    {
        return $this->role_id == self::ROLE_ADMIN;
    }

    public function isTest(): bool
    {
        return $this->role_id == self::ROLE_TEST;
    }

    public function isCustomer(): bool
    {
        return $this->role_id == self::ROLE_USER;
    }

    public function hasSubscription(): bool
    {
        return $this->currentPlanPrice !== null;
    }

    public function hasOneTimePaid(): bool
    {
        return $this->plan_id !== null;
    }

    public function needToShowTestOffer(): bool
    {
        return $this->is_wanna_test === null
            && !$this->hasSubscription()
            && $this->isCustomer()
            && SettingService::getValueByName('user_can_start_test') == 1;
    }

    public static function isOldUser(): bool
    {
        $user = \Auth::user();

        if ($user) {
            $is_user_seen_guide = $user->is_guide_seen;
            if (!$user->is_guide_seen)
                $user->update(['is_guide_seen' => 1]);

            return $is_user_seen_guide;
        }

        return false;
    }

    public function hasRole(): bool
    {
        return $this->role_id !== null;
    }
    /** /\ End Custom /\ */

}
