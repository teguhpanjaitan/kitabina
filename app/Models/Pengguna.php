<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class Pengguna extends Model
{
    //
    protected $table = "users";

    public function getDatatables()
    {
        $users = DB::table('users')
            ->select("*");

        return Datatables::of($users)
            ->addColumn('level', function ($user) {
                return ($user->role == 1) ? "super admin" : "admin";
            })
            ->addColumn('akses', function ($user) {
                if ($user->role == 1) {
                    return "All";
                } else {
                    $results = DB::table('user_pondok')
                        ->select("pondok.name")
                        ->join('pondok', 'pondok.id', '=', 'user_pondok.pondok_id')
                        ->where("user_pondok.user_id","=",$user->id)
                        ->get();

                    $pondok = "";
                    foreach($results as $result){
                        $pondok .= $result->name . "<br>";
                    }
                    
                    return $pondok;
                }
            })
            ->escapeColumns(['*'])
            ->make(true);
    }
}
