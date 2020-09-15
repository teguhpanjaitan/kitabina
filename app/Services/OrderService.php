<?php

namespace App\Services;

use App\Models\Stock;

class OrderService
{
    public function getAllWithPagination($limit = 10)
    {
        return Stock::paginate($limit);
    }

    public function create($data)
    {
        $stock = Stock::create([
            'product_id' => $data['product_id'],
            'amount' => $data['amount'],
        ]);
        return $stock;
    }

    public function update($data)
    {
        $stock = Stock::where('id', $data['id'])
            ->update([
                'product_id' => $data['product_id'],
                'amount' => $data['amount'],
            ]);
        return $stock;
    }

    public function destroy($ids)
    {
        foreach ($ids as $id) {
            Stock::where('id', $id)
                ->delete();
        }
    }

    public function findById($id)
    {
        $stock = Stock::where('id', '=', $id)->first();

        if (empty($stock)) {
            return false;
        } else {
            return $stock;
        }
    }

    public function findByProductId($productId)
    {
        $stock = Stock::where('product_id', '=', $productId)->first();

        if (empty($stock)) {
            return false;
        } else {
            return $stock;
        }
    }
}
