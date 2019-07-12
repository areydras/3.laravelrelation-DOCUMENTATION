<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
                        //nama model bisa lebih dari satu ['user','lesson']
    protected $touches = ['user']; //maka jika ada query update dari controller data updated_at yg ada di model User(table user) akan ikut terubah

    public function user(){
        // belongsTo artinya passport ini punya nya (user)
        return $this->belongsTo('App\Models\User'); 
        //belongs to itu kebalikannya dari hasOne atau hasMany, artinya jika ingin mengakses data dari foreign key ke primary key/induk nya memakai belongs to, dan kebalikannya menggunakan hasOne
    }
}
