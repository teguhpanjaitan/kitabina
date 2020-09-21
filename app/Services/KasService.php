<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Models\Kas;

class KasService
{
    public function getAll()
    {
        return Kas::all();
    }

    public function create($data)
    {
        $pondok = Kas::create([
            'pondok_id' => $data['pondok'],
            'user_id' => Auth::id(),
            'type' => ($data['type'] == "pemasukan") ? "1" : "2",
            'amount' => $data['amount'],
            'info' => $data['info']
        ]);
        return $pondok;
    }

    public function update($data)
    {
        $pondok = Kas::where('id', $data['id'])
            ->update([
                'pondok_id' => $data['pondok'],
                'user_id' => Auth::id(),
                'type' => ($data['type'] == "pemasukan") ? "1" : "2",
                'amount' => $data['amount'],
                'info' => $data['info']
            ]);
        return $pondok;
    }

    public function destroy($ids)
    {
        foreach ($ids as $id) {
            Kas::where('id', $id)
                ->delete();
        }
    }

    public function findById($id)
    {
        $pondok = Kas::where('id', '=', $id)->first();

        if (empty($pondok)) {
            return false;
        } else {
            return $pondok;
        }
    }
}
