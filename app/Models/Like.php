<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function likeable(){
        return $this->morphTo(); //artinya polymorphic, menjadikan Model Like sebagai polymoprhic (one to many)
    }
}
