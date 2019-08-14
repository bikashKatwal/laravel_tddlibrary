<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];
    protected $dates = ['dob'];

    //set+Dob (column name from db)+Attribute==setDobAttribute//accessor
    public function setDobAttribute($dob){
        $this->attributes['dob'] = Carbon::parse($dob);
    }

}
