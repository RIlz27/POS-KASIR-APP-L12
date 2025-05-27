<?php

namespace App\Models;

use Illminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Produk;

class DetailTransaksi extends Model
{
    protected $fillable = ['transaksi_id', 'produk_id', 'jumlah'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
