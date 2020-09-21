<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\All;
use stdClass;

class Kas extends Model
{
    //
    protected $fillable = ['pondok_id', 'user_id', 'type', 'info', 'amount'];
    protected $table = "kas";
    private $allHelper;

    public function __construct()
    {
        parent::__construct();
        $this->allHelper = new All();
    }

    public function getDatatables()
    {
        $kas = DB::table('kas')
            ->select("*");

        return Datatables::of($kas)
            ->addColumn('action', function ($singKas) {
                $class = ($singKas->type == "1") ? "edit-pemasukan" : "edit-pengeluaran";
                return '<a href="#' . $class . '" class="edit" data-toggle="modal" data-id="' . $singKas->id . '"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
            <a href="#destroy" class="delete" data-toggle="modal" data-id="' . $singKas->id . '"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
            })
            ->addColumn('checkbox', function ($singKas) {
                return '<span class="custom-checkbox">
                <input type="checkbox" name="options[]" value="' . $singKas->id . '">
                <label for="checkbox"></label>
            </span>';
            })
            ->addColumn('pondok', function ($singKas) {
                $result = DB::table('pondok')
                    ->select("name")
                    ->where("id", "=", $singKas->pondok_id)
                    ->first();

                return $result->name;
            })
            ->addColumn('pemasukan', function ($singKas) {
                return ($singKas->type == "1") ? $this->allHelper->rupiah($singKas->amount) : "";
            })
            ->addColumn('pengeluaran', function ($singKas) {
                return ($singKas->type == "1") ? "" : $this->allHelper->rupiah($singKas->amount);
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function getAllSaldo()
    {
        $pondoks = DB::table('pondok')
            ->select("*")->get();

        $saldo = [];
        
        foreach($pondoks as $pondok)
        {
            $cashes = DB::table('kas')
            ->select("*")
            ->where("pondok_id", "=", $pondok->id)
            ->get();

            $amount = 0;
            foreach($cashes as $cash){
                if($cash->type == '1'){
                    $amount += $cash->amount;
                }
                else{
                    $amount -= $cash->amount;
                }
            }

            $obj = new stdClass();
            $obj->pondok = $pondok->name;
            $obj->amount = $this->allHelper->rupiah($amount);

            $saldo[] = $obj;
        }

        return $saldo;
    }
}
