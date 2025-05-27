<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EduPlanCompetency extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'edu_plan_id',
        'competency_id',
        'created_at',
        'updated_at'
    ];
}
