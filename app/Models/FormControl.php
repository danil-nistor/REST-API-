<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormControl extends Model
{
    protected $table = 'form_control';
    public $timestamps = false;
    protected $fillable = [
        'title'
    ];
}
