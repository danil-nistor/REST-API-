<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplLoadStream extends Model
{
    protected $table = 'empl_loads_streams';
    protected $fillable = [
        'empl_loads_id1',
        'empl_loads_id2'
    ];
    public $timestamps = false;
}
