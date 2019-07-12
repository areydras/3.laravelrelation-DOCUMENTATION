<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function users(){
        //sama seperti function lessons yg ada di model User
        return $this->belongsToMany('App\Models\User')->withTimestamps(); //berfungsi agar column created_at dan updated_at bisa diakses(ditampilkan ke view), karna belongsToMany hanya akan menampilkan data dari foreign key saja tidak menampilkan data yg ada di tabel penghubung
        // jika ingin menampilkan kolom selain timestamps dan juga foreign key nya, tinggal tambahkan withPivot('nama_kolum') jika lebih dari satu withPivot(['kolum_1','kolum_2']) 
        // jika hanya ingin menampilkan data yg lebih spesifik wherePivot('nama_kolum', 'key') = contoh ('data', 'hp') hanya akan menampilkan data yg kolumnya data dan isinya adalah hp
        // jika ingin menampilkan beberapa syarat selain hp tinggal wherePivotIn('nama_kolum, ['key_1','key_2'])
    }

    public function likes(){
                                // nama Model,nama table penghubung(polymorphic)
        return $this->morphMany('App\Models\Like', 'likeable'); //morphMany digunakan untuk mengakses tipe polymorphic pada function likeable, (one to many)
    }

    public function tags(){
                                    // nama Model,nama table penghubung(polymorphic)
        return $this->morphToMany('App\Models\tag', 'tagable'); //morphToMany digunakan untuk mengakses tipe polymorphic pada function lessons, (many to many)
    }
}
