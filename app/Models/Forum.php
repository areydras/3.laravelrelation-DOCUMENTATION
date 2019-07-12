<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = ['created_at'];
    
    public function user(){
        // belongsTo artinya Forum ini punya nya (user)
        return $this->belongsTo('App\Models\User'); 
        //belongs to itu kebalikannya dari hasOne atau hasMany, artinya jika ingin mengakses data dari foreign key ke primary key/induk nya memakai belongs to, dan kebalikannya menggunakan hasOne
    }
}
