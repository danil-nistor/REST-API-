<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'speciality';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'cod',
        'profile',
        'edu_level_id'
    ];
}
