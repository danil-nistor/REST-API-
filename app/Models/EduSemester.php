<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduSemester extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'edu_plan_id',
        'semester',
        'zed',
        'lecture',
        'practice',
        'laboratory',
        'ind_work'
    ];
}
