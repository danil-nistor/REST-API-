<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitlePlan extends Model
{
    protected $table = 'title_plan';
    public $timestamps = false;
    protected $fillable = [
        'spec_id',
        'profile',
        'date_uchsovet',
        'number_uchsovet',
        'current_year',
        'date_enter',
        'date_fgos',
        'number_fgos',
        'department_id',
        'included'
    ];
}
