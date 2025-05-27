<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplLoad extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'load_id',
        'semester',
        'employee_id',
        'hourly_fund',
        'edu_semester_id',
        'subject',
        'group_id',
        'subject_form_id',
        'hours_other',
        'hours_contact'
    ];
}
