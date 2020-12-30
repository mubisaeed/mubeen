<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable=[
        'title',
        'image',
        'description'
    ];
}