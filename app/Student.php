<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table ='students';
    protected $fillable = [
        'name', 'phone', 'image', 'cnic', 'address', 'class', 'father_name', 'rollno'
    ];
    public function courses()
    {
    	return $this->belongsToMany( Course::class, 'student_courses');
    }
}
