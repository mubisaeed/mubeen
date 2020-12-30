<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table ='schools';
    protected $fillable = [
        'name', 'logo', 'owner_name', 'owner_address', 'address'];
}
