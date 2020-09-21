<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KasRequest;
use App\Services\PondokService;
use App\Services\KasService;
use App\Models\Kas;

class KasController extends Controller
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
    public function index(PondokService $pondokService)
    {
        $pondoks = $pondokService->getAll();
        return view('default.admin.pages.kas', compact("pondoks"));
    }

    public function datatables(Kas $kasModel)
    {
        return $kasModel->getDatatables();
    }

    public function createUpdatePemasukan(
        KasRequest $request,
        KasService $kasService
    ) {
        if ($request->action === "create") {
            $kasService->create($request->all());
            return redirect()->back()->withSuccess("Kas berhasil disimpan");
        } elseif ($request->action === "update") {
            $kasService->update($request->all());
            return redirect()->back()->withSuccess("Kas berhasil diupdate");
        } else {
            return redirect()->back();
        }
    }

    public function createUpdatePengeluaran(
        KasRequest $request,
        KasService $kasService
    ) {
        if ($request->action === "create") {
            $kasService->create($request->all());
            return redirect()->back()->withSuccess("Kas berhasil disimpan");
        } elseif ($request->action === "update") {
            $kasService->update($request->all());
            return redirect()->back()->withSuccess("Pondok berhasil diupdate");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(
        Request $request,
        KasService $kasService
    ) {
        $ids = json_decode($request->ids);
        $kasService->destroy($ids);

        return redirect()->back();
    }

    public function getById(
        $id,
        KasService $kasService
    ) {
        $kas = $kasService->findById($id);

        if ($kas) {
            return json_encode($kas);
        } else {
            return "{}";
        }
    }
}
