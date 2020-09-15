<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;

class ProductController extends Controller
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
        return view('default.admin.pages.product');
    }

    public function datatables(Product $productModel)
    {
        return $productModel->getDatatables();
    }

    public function createUpdate(
        ProductRequest $request,
        ProductService $productService
    ) {
        if ($request->action === "create") {
            if (!$productService->findByName($request->name)) {
                $productService->create($request->all());
                return redirect()->back()->withSuccess("Produk baru berhasil diinput");
            } else {
                return redirect()->back()->withErrors("Produk {$request->name} sudah ada");
            }
        } elseif ($request->action === "update") {
            $productService->update($request->all());
            return redirect()->back()->withSuccess("Produk berhasil diupdate");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(
        Request $request,
        ProductService $productService
    ) {
        $ids = json_decode($request->ids);
        $productService->destroy($ids);

        return redirect()->back();
    }

    public function getById(
        $id,
        ProductService $productService
    ) {
        $product = $productService->findById($id);

        if ($product) {
            return json_encode($product);
        } else {
            return "{}";
        }
    }
}
