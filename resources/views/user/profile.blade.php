<h1>Halo {{ $user->name }} | Passport kamu adalah {{ $user->passport->no_passport }} </h1> 
{{-- 
    $user = User Model dan function passport itu ada didalam user model. cek di User.php
    $user->passport->no_passport = menggunakan variabel user dengan function passport kemudian tampilkan no passport
    --}}

<h3>Daftar Forum</h3>
<ul>
    @foreach ($user->forums as $forum) <!-- berarti memanggil function forums yg ada di model user -->
        <li>
            {{ $forum->title }}
        </li> 
    @endforeach
</ul>

<h3>Daftar Kelas</h3>
<ul>
    @foreach ($user->lessons as $lesson) <!-- berarti memanggil function forums yg ada di model user -->
        <li>
            {{ $lesson->title }}
        </li> 
    @endforeach
</ul>


{{-- Cara menambahkan query builder tambahan --}}
@foreach ($user->forums()->where('id', 2) as $forum) {{-- harus ditambahkan Buka tutup kurung agar dia dibacanya fungsi, dan bisa mengakses query builder tambahan --}}
@foreach ($user->forums()->has('tags')->get() as $forum) {{-- artinya dia akan menampilkan forum yg hanya mempunya tags. liat di model user function forums. untuk lebih ngerti lagi liat di model tag tentang polymorphic /table tags di database itu saling berhubungan --}}
@foreach ($user->forums()->has('tags', '>', '1')->get() as $forum) {{-- Artinya dia hanya menampilkan forum yg mempunya tags lebih dari 1 --}}

<h3>Daftar Forum</h3>
<ul>
    @foreach ($user->forums as $forum) <!-- berarti memanggil function forums yg ada di model user -->
        <li>
            {{ $forum->title }}
        </li> 
    @endforeach
</ul>
