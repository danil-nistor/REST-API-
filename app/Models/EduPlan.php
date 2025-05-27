<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduPlan extends Model
{
    protected $table = 'edu_plan';
    public $timestamps = false;
    protected $fillable = [
        'block_id',
        'subject_id',
        'code_subject',
        'department_id',
        'title_plan_id'
    ];
}
