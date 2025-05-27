<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduPlanFormControl extends Model
{
    protected $table = 'edu_plan_form_control';
    public $timestamps = false;
    protected $fillable = [
        'edu_semester_id',
        'form_control_id'
    ];
}
