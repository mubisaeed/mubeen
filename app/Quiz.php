<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table ='quizzes';

    protected $fillable = [

        'name', 'clas_id', 'course_id'

        ];
}
