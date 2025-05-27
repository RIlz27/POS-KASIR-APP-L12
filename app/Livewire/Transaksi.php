<?php

namespace App\Livewire;

use App\Models\DetailTransaksi;
use App\Models\Transaksi as ModelsTransaksi;
use Livewire\Component;
use App\Models\Produk;

class Transaksi extends Component
{
    public $kode, $total, $kembalian = 0, $totalSemuaBelanja = 0;
    public $bayar = 0;
    public $transaksiAktif;

    public function transaksiBaru()
    {
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->bayar = 0;
        $this->transaksiAktif->save();
    }

    public function hapusProduk($id)
    {
        $detail = DetailTransaksi::find($id);
        if ($detail) {
            $produk = Produk::find($detail->produk_id);
            $produk->stok += $detail->jumlah;
            $produk->save();
        }
        $detail->delete();
    }

    public function transaksiSelesai()
    {
        $this->transaksiAktif->total = $this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();
        $this->reset();
    }
    public function batalTransaksi()
    {
        if ($this->transaksiAktif) {
            $detailTransaksi = DetailTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detailTransaksi as $detail) {
                $produk = Produk::find($detail->produk_id);
                $produk->stok += $detail->jumlah;
                $produk->save();
                $detail->delete();
            }
            $this->transaksiAktif->delete();
        }
        $this->reset();
        // $this->transaksiAktif->delete();
    }
    public function updatedKode()
    {
        $produk = Produk::where('kode', $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detail = DetailTransaksi::firstOrNew([
                'transaksi_id' => $this->transaksiAktif->id,
                'produk_id' => $produk->id,
            ], [
                'jumlah' => 0,
            ]);
            $detail->jumlah += 1;
            $detail->save();
            $produk->stok -= 1;
            $produk->save();
            $this->reset('kode');
        }
    }

    public function updatedBayar()
    {
        $bayar = (float) $this->bayar;
        $total = (float) $this->totalSemuaBelanja;

        // Hindari kembalian minus kalau bayar belum diisi
        if ($bayar <= 0) {
            $this->kembalian = 0;
        } else {
            $this->kembalian = $bayar - $total;
        }
    }

    public function render()
    {
        if ($this->transaksiAktif) {
            $semuaProduk = DetailTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSemuaBelanja = $semuaProduk->sum(function ($detail) {
                return $detail->produk->harga * $detail->jumlah;
            });
        } else {
            $semuaProduk = [];
        }
        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk,
        ]);
    }
}
