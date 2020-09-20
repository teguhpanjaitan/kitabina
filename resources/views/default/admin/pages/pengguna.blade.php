@extends('default.admin.layout')

@section('content')
<div class="container-xl">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Pengguna</h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="pengguna">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Akses</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_head')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@push('scripts')
<script>
    $(function() {
        $('#pengguna').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'pengguna/datatables',
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'akses',
                    name: 'akses'
                }
            ]
        });
    });
</script>
@endpush