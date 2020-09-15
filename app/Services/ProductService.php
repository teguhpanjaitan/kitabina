<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll()
    {
        return Product::all();
    }

    public function create($data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'unit_id' => $data['unit_id'],
        ]);
        return $product;
    }

    public function update($data)
    {
        $product = Product::where('id', $data['id'])
            ->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'price' => $data['price'],
                'unit_id' => $data['unit_id']
            ]);
        return $product;
    }

    public function destroy($ids)
    {
        foreach ($ids as $id) {
            Product::where('id', $id)
                ->delete();
        }
    }

    public function findByName($name)
    {
        $product = Product::where('name', '=', $name)->first();

        if (empty($product)) {
            return false;
        } else {
            return $product;
        }
    }

    public function findById($id)
    {
        $product = Product::where('id', '=', $id)->first();

        if (empty($product)) {
            return false;
        } else {
            return $product;
        }
    }

    public function getCategoryNameById($category_id)
    {
        $categories = [1 => "Bumbu Dapur", 2 => "Sayuran", 3 => "Buah-buahan"];
        return isset($categories[$category_id]) ? $categories[$category_id] : "";
    }

    public function getUnitNameByUnitId($unit_id)
    {
        $units = [1 => "G", 2 => "Kg", 3 => "Ikat", 4 => "Bagian"];
        return isset($units[$unit_id]) ? $units[$unit_id] : "";
    }

    public function getNameById($id)
    {
        $product = $this->findById($id);

        if ($product) {
            return $product->name;
        } else {
            return "";
        }
    }

    public function getUnitNameById($id)
    {
        $product = $this->findById($id);

        if ($product) {
            return $this->getUnitNameByUnitId($product->unit_id);
        } else {
            return "";
        }
    }
}
