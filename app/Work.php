<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    protected $fillable = array('file','student_id','assignment_id');

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }
}
