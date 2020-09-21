@extends('default.admin.layout')

@section('content')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Pondok</th>
                        <th scope="col">Kas Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saldos as $saldo)
                    <tr>
                        <td>{{$saldo->pondok}}</td>
                        <td>{{$saldo->amount}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection