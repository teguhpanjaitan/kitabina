<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PondokRequest;
use App\Services\PondokService;
use App\Models\Pondok;

class PondokController extends Controller
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
        return view('default.admin.pages.pondok');
    }

    public function datatables(Pondok $pondokModel)
    {
        return $pondokModel->getDatatables();
    }

    public function createUpdate(
        PondokRequest $request,
        PondokService $pondokService
    ) {
        if ($request->action === "create") {
            if (!$pondokService->findByName($request->name)) {
                $pondokService->create($request->all());
                return redirect()->back()->withSuccess("Pondok baru berhasil disimpan");
            } else {
                return redirect()->back()->withErrors("Pondok {$request->name} sudah ada");
            }
        } elseif ($request->action === "update") {
            $pondokService->update($request->all());
            return redirect()->back()->withSuccess("Pondok berhasil diupdate");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(
        Request $request,
        PondokService $productService
    ) {
        $ids = json_decode($request->ids);
        $productService->destroy($ids);

        return redirect()->back();
    }

    public function getById(
        $id,
        PondokService $productService
    ) {
        $product = $productService->findById($id);

        if ($product) {
            return json_encode($product);
        } else {
            return "{}";
        }
    }
}
