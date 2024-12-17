<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_informatio extends Model
{

protected $fillable = [

    'name',
    'rollNumber',
    'batchNo',
    'age',
    'gender',
    'email',
    'phone',
    'address',
    'fatherName',
    'motherName',
    'date',
    'admissionDate',
    'class',
    'section',
    'collegeName',
    'department',
    'guardiaName',
    'guardianContact',
    'attachment'
    
];
}
