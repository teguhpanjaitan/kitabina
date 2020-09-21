<?php

namespace App\Helpers;

class All
{
    public function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function getKasType($id)
    {
        return ($id == "1") ? "pemasukan" : "pengeluaran";
    }

    public function getKasTypeId($name)
    {
        return ($name == "pemasukan") ? "1" : "2";
    }
}
