<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyValue extends Model
{

    protected $fillable = ['company_id', 'company_property_id', 'company_property_value_id'];

}
