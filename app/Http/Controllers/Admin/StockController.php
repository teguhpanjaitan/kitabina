<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use Illuminate\Http\Request;
use App\Services\StockService;
use App\Services\ProductService;
use App\Models\Stock;

class StockController extends Controller
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
    public function index(ProductService $productService)
    {
        $products = $productService->getAll();
        return view('default.admin.pages.stock', compact("products"));
    }

    public function datatables(Stock $stockModel)
    {
        return $stockModel->getDatatables();
    }

    public function createUpdate(
        StockRequest $request,
        StockService $stockService
    ) {
        if ($request->action === "create") {
            if (!$stockService->findByProductId($request->product_id)) {
                $stockService->create($request->all());
                return redirect()->back()->withSuccess("Stok baru berhasil diinput");
            } else {
                return redirect()->back()->withErrors("Stok sudah ada");
            }
        } elseif ($request->action === "update") {
            $stockService->update($request->all());
            return redirect()->back()->withSuccess("Stok berhasil diupdate");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(
        Request $request,
        StockService $stockService
    ) {
        $ids = json_decode($request->ids);
        $stockService->destroy($ids);

        return redirect()->back();
    }

    public function getById(
        $id,
        StockService $stockService
    ) {
        $stock = $stockService->findById($id);

        if ($stock) {
            return json_encode($stock);
        } else {
            return "{}";
        }
    }
}
