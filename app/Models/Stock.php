<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    //
    protected $fillable = ['product_id', 'amount'];

    public function getDatatables()
    {
        $stocks = DB::table('stocks')
            ->select(DB::raw("stocks.*,products.name as product,units.name as unit"))
            ->leftJoin('products', 'stocks.product_id', '=', 'products.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id');

        return Datatables::of($stocks)
            ->addColumn('action', function ($stock) {
                return '<a href="#edit" class="edit" data-toggle="modal" data-id="' . $stock->id . '"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#destroy" class="delete" data-toggle="modal" data-id="' . $stock->id . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
            })
            ->addColumn('checkbox', function ($stock) {
                return '<span class="custom-checkbox">
                <input type="checkbox" name="options[]" value="' . $stock->id . '">
                <label for="checkbox"></label>
            </span>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }
}
