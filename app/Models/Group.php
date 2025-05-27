<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'galactika_number',
        'year',
        'speciality_id'
    ];
}
