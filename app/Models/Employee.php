<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronimyc',
        'address',
        'birthdate',
        'sex',
        'phone',
        'email',
        'base_education',
        'qualification',
        'bachelor_speciality',
        'master_speciality',
        'specialist_speciality',
        'phd_speciality',
        'bachelor_qualification',
        'master_qualification',
        'specialist_qualification',
        'phd_qualification',
        'orcid_url',
        'scopus_url',
        'mathnet_url',
        'clarivate_url',
        'deleted'
    ];
}
