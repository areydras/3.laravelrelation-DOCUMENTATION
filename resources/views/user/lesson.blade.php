<h1>{{ $lesson->title }}</h1> 

<h3>Daftar User</h3>
<ul>
    @foreach ($lesson->users as $user) <!-- berarti memanggil function forums yg ada di model user -->
        <li>
            {{ $user->name }} - {{ $user->pivot->created_at }} <!-- pivot adalah table penghubung antara users dan lessons. jadi disini berarti kita mengambil data created_at yg ada di pivot -->
        </li> 
    @endforeach
</ul>

<h4>Tag</h4>
@foreach ($lesson->tags as $tag)
    {{ $tag->name }}
@endforeach

<p>Like : {{ $lesson->likes->count() }} </p> <!-- Membuka function likes yg ada di model lesson kemudian dihitung berapa jumlahnya -->