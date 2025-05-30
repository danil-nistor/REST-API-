<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';
    public $timestamps = false;
    protected $fillable = [
        'block_title',
        'part_title'
    ];

}
