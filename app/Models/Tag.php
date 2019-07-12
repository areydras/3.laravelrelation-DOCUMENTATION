<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    //membuat function berdasarkan halaman misalnya untuk halaman lesson
    public function lessons(){
                                    //nama model, nama table penghubung(polymorphic)
        return $this->morphByMany('App\Models\Lesson', 'tagable'); //morphByMany digunakan untuk polymorphic many to many. artinya berarti ini polymorphic punyanya model lesson
    }

    //membuat function berdasarkan halaman misalnya untuk halaman Forum
    public function forums()
    {
                                    //nama model, nama table penghubung(polymorphic)
        return $this->morphByMany('App\Models\Forum');
    }
}
