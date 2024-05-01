<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Executive extends Model
{
    use Searchable;

    const ALL_PROPERTIES = [
        'industries',
        'functions',
        'specialties',
        'capabilities'
    ];

    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'address',
        'phone',
        'industries',
        'functions',
        'specialties',
        'capabilities',
        'url'
    ];

    protected $casts = [
        'industries' => 'array',
        'functions' => 'array',
        'specialties' => 'array',
        'capabilities' => 'array'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getJobTitleAttribute()
    {
        $function = $this->functions[0] ?? null;
        if ($function)
            $function .= ', ';

        return $function . $this->company;
    }

    public function getIndustryTitleAttribute()
    {
        return $this->industries[0] ?? '';
    }

}
