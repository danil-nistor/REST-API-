<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $table = 'competence';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'description',
        'speciality_id'
    ];

}
