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
                        <h2>Manajemen <b>Stok</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#add" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Stok</span></a>
                        <a href="#destroy" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Hapus</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" id="stock">
                <thead>
                    <tr>
                        <th>
                            &nbsp;
                        </th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal HTML -->
<div id="add" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stok</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" name="product_id">
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ Facades\App\Services\ProductService::getUnitNameByUnitId($product->unit_id) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="create" />
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" value="Tambahkan">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="edit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Stok</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Produk</label>
                        <select class="form-control" name="product_id">
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ Facades\App\Services\ProductService::getUnitNameByUnitId($product->unit_id) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="id" value="" />
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
            <form method="post" action="<?= route("stock_destroy") ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Barang</h4>
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
        $('#stock').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'stock/datatables',
            columns: [{
                    data: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product',
                    name: 'products.name'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'unit',
                    name: 'units.name'
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

    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");

        $.get("<?= route('stock') ?>/" + id)
            .done(function(stock) {
                stock = JSON.parse(stock);
                if (stock.id) {
                    $('#edit input[name="id"]').val(stock.id);
                    $('#edit select[name="product_id"]').val(stock.product_id);
                    $('#edit input[name="amount"]').val(stock.amount);
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