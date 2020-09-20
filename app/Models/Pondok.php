<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class Pondok extends Model
{
    protected $fillable = ['name', 'address'];
    protected $table = 'pondok';

    public function getDatatables()
    {
        $pondoks = DB::table('pondok')
            ->select("*");

        return Datatables::of($pondoks)
            ->addColumn('action', function ($pondok) {
                return '<a href="#edit" class="edit" data-toggle="modal" data-id="' . $pondok->id . '"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#destroy" class="delete" data-toggle="modal" data-id="' . $pondok->id . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
            })
            ->addColumn('checkbox', function ($pondok) {
                return '<span class="custom-checkbox">
                <input type="checkbox" name="options[]" value="' . $pondok->id . '">
                <label for="checkbox"></label>
            </span>';
            })
            ->escapeColumns(['*'])
            ->make(true);
    }
}
