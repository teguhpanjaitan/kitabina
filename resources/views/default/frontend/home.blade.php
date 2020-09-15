@extends('default.frontend.layout')

@section('content')
<div class="content">
    <div class="title m-b-md">
        Keday ID
    </div>

    @guest
    <p>
        Belanja Mudan dan Murah
    </p>
    @else
    <p>
        Here is your <a href="{{ route('dashboard') }}">Dashboard</a>
    </p>
    @endguest
</div>
@endsection