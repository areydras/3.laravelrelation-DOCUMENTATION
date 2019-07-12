<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function passport(){ // one to one 
        return $this->hasOne('App\Models\Passport'); //hasOne artinya User(Models/table userini) punya satu passport ('App\Models\Passport')

        //jika foreign key nya tidak pakai id / tidak sesuai seperti nama table parent nya contoh: table users berarti nama foreignnya harus user_id
        // return $this->hasOne('App\Models\Passport', 'foreign_key', 'local_id(id ditable parent)');
    }

    // one to many = artinya satu user bisa punya beberapa forum
    public function forums(){
        return $this->hasMany('App\Models\Forum');
    }

    // many to many = artinya satu user punya banyak pelajaran dan satu pelajaran juga punya banyak user
    public function lessons(){
        return $this->belongsToMany('App\Models\Lesson'); //belongsToMany('nama model yg ingin digabungkan') artinya yg akan dilihat id nya
        // misal model user ini akan dilihat id yg ada ditable users dan digabungkan ke tabel lesson dan dicari id nya
        // kemudian mengakses tabel penghubung antara table users dan lessons. yg mempunya foreign key lesson_id dan user_id

        // Jika nama tabel penghubungnya bukan dari gabungan table satu dengan tabel kedua maka ditulis seperti ini
        // return $this->belongsToMany('App\Models\User', 'tabel_penghubung', 'foreign_key_table_1', 'foreign_key_table_2');
    }
}
