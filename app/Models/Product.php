<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //
    protected $fillable = ['name', 'category_id', 'price', 'unit_id'];

    public function getDatatables()
    {
        $products = DB::table('products')
            ->select(DB::raw("products.*,'-' as image,units.name unit,product_categories.name category"))
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id');

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<a href="#edit" class="edit" data-toggle="modal" data-id="' . $product->id . '"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#destroy" class="delete" data-toggle="modal" data-id="' . $product->id . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
            })
            ->addColumn('checkbox', function ($product) {
                return '<span class="custom-checkbox">
                <input type="checkbox" name="options[]" value="' . $product->id . '">
                <label for="checkbox"></label>
            </span>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }
}
