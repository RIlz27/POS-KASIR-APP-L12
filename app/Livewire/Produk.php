<?php

namespace App\Livewire;

use App\Models\Produk as ModelProduk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImportProduk;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Produk extends Component
{
    use WithFileUploads;
    public $pilihanMenu = 'lihat';
    public $gambar;
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;
    public $fileExcell;


    public function importExcel()
    {
        $this->validate([
            'fileExcell' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            $this->fileExcell->storeAs('temp', $this->fileExcell->getClientOriginalName());

            $fullPath = storage_path('app/temp/' . $this->fileExcell->getClientOriginalName());

            Excel::import(new ImportProduk, $fullPath);

            $this->reset(['fileExcell']);

            session()->flash('message', '✅ Import berhasil!');
        } catch (\Exception $e) {
            // log error ke laravel.log
            Log::error('Import Gagal: ' . $e->getMessage());

            session()->flash('error', '❌ Gagal import: ' . $e->getMessage());
        }
    }




    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->gambar = null; // Reset gambar agar tidak mengganggu input baru
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate(
            [
                'nama' => 'required',
                'kode' => ['required', 'unique:produks,kode,' . $this->produkTerpilih->id],
                'gambar' => 'required|image|max:1024',
                'harga' => 'required',
                'stok' => 'required'
            ],
            [
                'nama.required' => 'Nama Harus Diisi',
                'kode.required' => 'kode Harus Diisi',
                'kode.unique' => 'kode Telah Digunakan',
                'harga.required' => 'harga Harus Diisi',
                'stok.required' => 'stok Harus Diisi',
                'gambar.required' => 'Gambar Harus Diisi',
            ]
        );
        $simpan = $this->produkTerpilih;
        $simpan->gambar = $this->gambar ? $this->gambar->store('produk', 'public') : $simpan->gambar;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset();
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function batal()
    {
        $this->reset();
    }
    public function simpan()
    {
        // Bersihkan harga dari format ribuan (titik)
        $this->harga = str_replace('.', '', $this->harga);

        $this->validate(
            [
                'nama' => 'required',
                'kode' => ['required', 'unique:produks,kode'],
                'harga' => 'required|numeric',
                'stok' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama Harus Diisi',
                'kode.required' => 'Kode Harus Diisi',
                'kode.unique' => 'Kode Telah Digunakan',
                'harga.required' => 'Harga Harus Diisi',
                'harga.numeric' => 'Harga Harus berupa angka',
                'stok.required' => 'Stok Harus Diisi',
                'stok.numeric' => 'Stok Harus berupa angka'
            ]
        );

        $simpan = new ModelProduk();
        $simpan->gambar = $this->gambar ? $this->gambar->store('produk', 'public') : null;
        if ($this->gambar && !$simpan->gambar) {
            session()->flash('error', 'Gagal mengunggah gambar produk!.');
            return;
        }
        if ($this->gambar && !in_array($this->gambar->extension(), ['jpg', 'jpeg', 'png'])) {
            session()->flash('error', 'Format gambar harus jpg, jpeg, atau png!!');
            return;
        }
        if ($this->gambar && $this->gambar->getSize() > 2048000) { // 2MB
            session()->flash('error', 'Ukuran gambar tidak boleh lebih dari 2MB!!');
            return;
        }
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->harga = $this->harga;
        $simpan->stok = $this->stok;
        $simpan->save();

        $this->reset(['gambar','nama', 'kode', 'stok', 'harga']);
        $this->pilihanMenu = 'lihat';
    }


    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}
