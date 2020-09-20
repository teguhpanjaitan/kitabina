<?php

namespace App\Services;

use App\Models\Pondok;

class PondokService
{
    public function getAll()
    {
        return Pondok::all();
    }

    public function create($data)
    {
        $pondok = Pondok::create([
            'name' => $data['name'],
            'address' => $data['address']
        ]);
        return $pondok;
    }

    public function update($data)
    {
        $pondok = Pondok::where('id', $data['id'])
            ->update([
                'name' => $data['name'],
                'address' => $data['address']
            ]);
        return $pondok;
    }

    public function destroy($ids)
    {
        foreach ($ids as $id) {
            Pondok::where('id', $id)
                ->delete();
        }
    }

    public function findByName($name)
    {
        $pondok = Pondok::where('name', '=', $name)->first();

        if (empty($pondok)) {
            return false;
        } else {
            return $pondok;
        }
    }

    public function findById($id)
    {
        $pondok = Pondok::where('id', '=', $id)->first();

        if (empty($pondok)) {
            return false;
        } else {
            return $pondok;
        }
    }
}
