<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PondokRequest;
use App\Services\PondokService;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('default.admin.pages.pengguna');
    }

    public function datatables(Pengguna $penggunaModel)
    {
        return $penggunaModel->getDatatables();
    }
}
