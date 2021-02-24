<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodesData extends Model
{
    protected $table ='students';

    protected $fillable = [

         'diabetes', 's_u_id',  'alergy', 'phone', 'image', 'cnic', 'address', 'class', 'father_name', 'rollno', 'gender', 'admission_date'

    ];
}
