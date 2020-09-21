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
                        <h2>Manajemen <b>Kas</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#pengeluaran" class="btn btn-warning" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Pengeluaran</span></a>
                        <a href="#pemasukan" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Pemasukan</span></a>
                        <a href="#destroy" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Hapus</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="kas">
                <thead>
                    <tr>
                        <th>
                            &nbsp;
                        </th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Pondok</th>
                        <th>Keterangan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal HTML -->
<div id="pemasukan" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= route("kas_pemasukan") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pemasukan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pondok</label>
                        <select name="pondok" class="form-control" required>
                        @foreach ($pondoks as $pondok)
                        <option value="{{ $pondok->id }}">{{ $pondok->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="info" class="form-control" required></textarea>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="create" />
                <input type="hidden" name="type" value="pemasukan" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Tambahkan">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Modal HTML -->
<div id="pengeluaran" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= route("kas_pengeluaran") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pondok</label>
                        <select name="pondok" class="form-control" required>
                        @foreach ($pondoks as $pondok)
                        <option value="{{ $pondok->id }}">{{ $pondok->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="info" class="form-control" required></textarea>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="create" />
                <input type="hidden" name="type" value="pengeluaran" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Tambahkan">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="edit-pemasukan" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= route("kas_pemasukan") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pemasukan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pondok</label>
                        <select name="pondok" class="form-control" required>
                        @foreach ($pondoks as $pondok)
                        <option value="{{ $pondok->id }}">{{ $pondok->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="info" class="form-control" required></textarea>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="" />
                <input type="hidden" name="type" value="pemasukan" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-info" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="edit-pengeluaran" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= route("kas_pengeluaran") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pengeluaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pondok</label>
                        <select name="pondok" class="form-control" required>
                        @foreach ($pondoks as $pondok)
                        <option value="{{ $pondok->id }}">{{ $pondok->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah (Rp)</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="info" class="form-control" required></textarea>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="" />
                <input type="hidden" name="type" value="pengeluaran" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-info" value="Edit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->
<div id="destroy" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= route("kas_destroy") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Pondok</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda ingin menghapus data ini?</p>
                    <p class="text-warning"><small>Data tidak bisa dikembalikan!</small></p>
                </div>
                @csrf
                <input type="hidden" name="ids" value="" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-danger" value="Hapus">
                </div>
            </form>
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
        $('#kas').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'kas/datatables',
            columns: [{
                    data: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created'
                },
                {
                    data: 'pemasukan',
                    name: 'pemasukan'
                },
                {
                    data: 'pengeluaran',
                    name: 'pengeluaran'
                },
                {
                    data: 'pondok',
                    name: 'pondok'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });

    $('#edit-pemasukan').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");

        $.get("<?= route('kas') ?>/" + id)
            .done(function(product) {
                product = JSON.parse(product);
                if (product.id) {
                    $('#edit-pemasukan input[name="id"]').val(product.id);
                    $('#edit-pemasukan select[name="pondok"]').val(product.pondok_id);
                    $('#edit-pemasukan input[name="amount"]').val(product.amount);
                    $('#edit-pemasukan textarea[name="info"]').val(product.info);
                }
            });
    });

    $('#edit-pengeluaran').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");

        $.get("<?= route('kas') ?>/" + id)
            .done(function(product) {
                product = JSON.parse(product);
                if (product.id) {
                    $('#edit-pengeluaran input[name="id"]').val(product.id);
                    $('#edit-pengeluaran select[name="pondok"]').val(product.pondok_id);
                    $('#edit-pengeluaran input[name="amount"]').val(product.amount);
                    $('#edit-pengeluaran textarea[name="info"]').val(product.info);
                }
            });
    });

    $('#destroy').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");

        if (id) {
            $('#destroy input[name="ids"]').val("[" + id + "]");
        } else {
            var ids = getDestroyIds();
            var jsonIds = JSON.stringify(ids);
            $('#destroy input[name="ids"]').val(jsonIds);
        }

    });

    function getDestroyIds() {
        var checkbox = $('table tbody input[type="checkbox"]');
        var result = [];

        $('table tbody input[type="checkbox"]:checked').each(function() {
            var value = $(this).val();
            result.push(parseInt(value));
        });

        return result;
    }
</script>
@endpush