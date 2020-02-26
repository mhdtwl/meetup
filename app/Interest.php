<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    public function group_interests()
    {
        return $this->hasMany(GroupInterest::class , 'interest_id' );
    }
}
