<?php

namespace App\Models;

use App\Enums\ContactGoalEnum;
use App\Enums\ContactRelationshipEnum;
use App\Enums\ContactStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company',
        'position',
        'contact_method',
        'location',
        'relationship',
        'contacted_at',
        'status',
        'goal',
        'notes',
    ];

    protected $casts = [
        'contacted_at' => 'date',
    ];



    public function scopeSearch($query, $value)
    {
        return $query->where(function ($q) use ($value) {
            $q->where('first_name', 'LIKE', "%{$value}%")
                ->orWhere('last_name', 'LIKE', "%{$value}%")
                ->orWhere('company', 'LIKE', "%{$value}%")
                ->orWhere('position', 'LIKE', "%{$value}%")
                ->orWhere('contact_method', 'LIKE', "%{$value}%")
                ->orWhere('location', 'LIKE', "%{$value}%");
        });
    }

    public function scopeHasPosition($query)
    {
        return $query->whereNotNull('position')
            ->where('position', '<>', '');
    }

    public function scopeHasLocation($query)
    {
        return $query->whereNotNull('location')
            ->where('location', '<>', '');
    }



    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getGoalTitleAttribute()
    {
        return ContactGoalEnum::tryFrom($this->goal)?->getTitle() ?? '';
    }

    public function getStatusTitleAttribute()
    {
        return ContactStatusEnum::tryFrom($this->status)?->getTitle() ?? '';
    }

    public function getStatusClassAttribute()
    {
        return ContactStatusEnum::tryFrom($this->status)?->getClass() ?? '';
    }

    public function getIsoContactedAtAttribute()
    {
        return $this->contacted_at?->isoFormat('lll') ?? '';
    }

    public function getCompanyAndPositionAttribute()
    {
        $output = '';
        $output .= $this->position ?: '';
        $output .= !empty($output)
            ? ', ' . $this->company
            : ($this->company ?: '');

        return $output;
    }

    public function getRelationshipTitleAttribute()
    {
        return ContactRelationshipEnum::tryFrom($this->relationship)?->getTitle() ?? '';
    }

    public function getPrettyContactedAtAttribute()
    {
        return $this->contacted_at?->format('d.m.Y') ?? null;
    }

    public function getSimpleContactedAtAttribute()
    {
        return $this->contacted_at?->format('Y-m-d') ?? null;
    }

}
