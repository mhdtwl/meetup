<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupInterest extends Model
{
    public function group()
    {
        return $this->belongsTo(Group::class , 'group_id' );
    }
    public function interest()
    {
        return $this->belongsTo(Interest::class , 'interest_id' );
    }
}
