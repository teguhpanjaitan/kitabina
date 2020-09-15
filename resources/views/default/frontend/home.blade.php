@extends('default.frontend.layout')

@section('content')
<div class="content">
    <div class="title m-b-md">
        Kita Bina
    </div>

    @guest
    <p>
        Pondok Tahfidz Qur'an Kitabina
    </p>
    @else
    <p>
        Here is your <a href="{{ route('dashboard') }}">Dashboard</a>
    </p>
    @endguest
</div>
@endsection