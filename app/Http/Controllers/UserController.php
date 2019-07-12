<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Passport;
use App\Models\Lesson;
use App\Models\City;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile($id){ //one to one relation = sama seperti user punya 1 passport dan passport juga hanya punya 1 user

        // Cara menampilkan berapa banyak jumlah forum yg dibuat oleh user
        $forums  = User::withCount('forums')->get(); 
        foreach($forums as $forum){
            echo $forum->name. ' ' .$forum->forums_count. '<br>'; // forums_count adalah sebuah column baru yg dibuat oleh withCount(), jadi setiap count yg baru dibuat didepannya itu nama modelnya contoh:
                                                                  // misalnya yg mau dicount itu tags, jadi nya tags_count 
        }
        //===========

        // HasManyThrough
        City::find(1)->forums; //artinya dia akan memanggil function forum, dan menampilkan semua data forum yg id_city nya itu 1
        //===========

        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    public function showPassport($id)
    { 
        return view('user.passport', ['passport' => Passport::findOrFail($id)]);
    }

    public function lesson($id){
        $lesson = Lesson::with('users')->findOrFail($id);
        // with berfungsi untuk memanggil function yg ada didalam model Lesson. with juga berfungsi sebagai eager loading dimana bisa membuat kinerja lebih cepat
        // karena saat foreach didalam lesson.blade.php tidak perlu lagi memanggil query yg ada di function users
        // kalo ingin memanggil dua function sekaligus tinggal pisahkan dengan , with('users','forum')
        return view('user.lesson', ['lesson' => $lesson]);
    }



    // Insert data dengan table yg sudah laravel relation
    public function createForum(){ //kalo pengen dinamis tinggal pake request
        //one to one
        $forum = new Forum([
            'title' => 'Forum Baru'
        ]);
        $user = User::find(2); // berarti mencari data user yg id nya dua
        $user->forums()->save($forum); //lalu menjalankan function forums di model user, kemudian simpan $forum yg dibuat
        //dalam arti dia bakal otomatis nyimpen ke table forum dengan title dari $forum dan user_id dari $user
        //berarti dia bakal nge save :
        // 'title' => 'forum Baru',
        // 'user_id' => 2

        // untuk menyimpan data dengan banyak
        $forum = new Forum([
            'title' => 'Forum Baru'
        ],[
            'title' => 'Forum Kedua'
        ]);
        $user = User::find(2); // berarti mencari data user yg id nya dua
        $user->forums()->saveMany($forum); //lalu menjalankan function forums di model user, kemudian simpan $forum yg dibuat
        
        //bisa juga dengan metode create
        $user->forums()->create([
            'title' => 'forum'
        ]);

        //kalo many to many 
        $user->forums()->create([
            'title' => 'forum'
        ], ['column_table_penghubung' => $nilai]);
    }


    //update delete relation, hanya akan mengubah dan menghapus user_id yg ada di tabel foreign (relation table), relation dengan belongsTo / belongsToMany (one to many)
    public function updateForum(){
        $forum = Forum::find(3); //mencari forum dengan id 3
        $user = User::find(1); //mencari user yg akan mengubah user_id di table forum

        $forum->user()->associate($user); //associate berfungsi mengupdate kolum yg terelasi dengan tabel forum. contohnya user_id yg ada ditabel forum
        $forum->save();
        //berarti gunakan forum dengan id 3 dan mengaksses function user() di model Forum, lalu mengubah data kolum relasi dengan id_user 1 dari $user
    }

    public function deleteForum(){
        $forum = Forum::find(3); //mencari forum dengan id 3

        $forum->user()->dissacoate(); //menghapus data column id_user yg ada di id_forum 3 menjadi null (artinya forum 3 ini tidak memiliki id_user)
        $forum->save();
    }


    //many to many create, delete
    public function createLesson(){
        $user = User::find(1); //mengambil data dengan id user 1
        $user->lessons()->attach(3); //lalu menjalankan function lesson()->tambahkan data ke table penghubung(lesson_user) dengan user_id 1 dan lesson_id 3
        //juga bisa menggunakan beberapa data attach(['1','2','3']) berarti menambkan data 3 sekaligus
        //juga bisa menggunakan intermediate attach(3, [key => kolom])
    }

    public function deleteLesson(){
        $user = User::find(1);
        $user->lessons()->detach(3);//lalu menjalankan function lesson()->hapus data dari table penghubung(lesson_user) dengan user_id 1 dan lesson_id 3
    }

    // update many to many
    public function updateLesson(){ //cara mengupdate data yg ada di kolum pivot, pivot adalah sebuah kolum selain foreign yg ada ditabel penghubung many to many (lesson_user)
        $user = User::find(1); //mencari data yg dari user_id 1
        $attributes = ['data' => 'coto']; // mengubah data yg ada dikolum data menjadi coto
        $user->lessons()->updateExistingPivot(2, $attributes); //2 adalah id dari table penghubung(lesson_user). dan mengubah datanya menjadi sesuai $attributes
        //mencari id 2 yg ada ditable penghubung(lesson_user), lalu mengubahnya sesuai data yg ada di $attributes
    }

    // sync
    public function syncLesson(){
        $user = User::find(1); //mencari data yg dari user_id 1
        $lists = [1,2]; // Memasukan data yg akan tetap ada didatabase (data dari user_id 1, yg selain id_lesson nya 1,2 maka akan dihapus). contoh jika ada 3 data 1,2,3 maka yg akan dihapus yg id 3, karna tidak ada didalam list
        $user->lessons()->sync($lists); 
    }
    

    //mengupdate parent 
    public function editPassport(){
        $passport = Passport::find(1);
        $passport->no_pass = '213921830912';
        $passport->save();
    }
}
