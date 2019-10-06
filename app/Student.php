<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Table name
    protected $table ='pupil';
    //primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
