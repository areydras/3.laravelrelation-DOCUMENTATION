<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function forums(){
                            //model yg ingin diakses, perantara yg mempunya foreign key untuk kedua table(ibaratnya user punya city_id dan forum punya user_id jadi forum bakal misa mengakses city_id dari user)
        return $this->hasManyThrough('App\Models\Forum', 'App\Models\User');

        // cara mengakses jika nama table tidak singular/plurar  (bukan seperti city = cities, user = users) (singular seperti city, user biasa digunakan untuk Model. plurar seperti users, cities biasa digunakan untuk table)
                                                                        // 'data yg ingin diakses', 'perantara dari user_id', 'id_dari yg ingin mengakses (forum)'
        return $this->hasManyThrough('App\Models\Forum', 'App\Models\User', 'city_id', 'user_id', 'id');

    }
}
