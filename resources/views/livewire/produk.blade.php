<div>
    <div class="container" style="margin-right:-40px; overflow-x:hidden; ">
        <div class="row my-2">
            <div class="col-12">
                <div class="tabs">
                    <button wire:click="pilihMenu('lihat')" class="btn tab {{ $pilihanMenu == 'lihat' ? 'active' : '' }}">
                        Semua produk
                    </button>

                    @if (Auth::user()->peran == 'admin')
                        <button wire:click="pilihMenu('tambah')"
                            class="btn tab {{ $pilihanMenu == 'tambah' ? 'active' : '' }}">
                            Tambah produk
                        </button>
                    @endif

                    @if (Auth::user()->peran == 'admin')
                        <button wire:click="pilihMenu('excel')"
                            class="btn tab {{ $pilihanMenu == 'excel' ? 'active' : '' }}">
                            Import produk
                        </button>
                    @endif
                    <button wire:loading class="btn btn-info">
                        loading...
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-10">
                @if ($pilihanMenu == 'lihat')
                    <div class="card table-custom">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th style="border-radius: 10px 0 0 10px;"></th>
                                    <th>Produk</th>
                                    <th></th>
                                    <th>Kode</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    @if (Auth::user()->peran == 'admin')
                                        <th style="border-radius: 0 10px 10px 0;">Data</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($produk->gambar)
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                                                    style="height: 50px;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ $produk->kode }}</td>
                                        <td> {{ number_format($produk->harga, 0, ',', '.') }} </td>
                                        <td>{{ $produk->stok }}</td>

                                        @if (Auth::user()->peran == 'admin')
                                            <td>
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn btn-edit {{ $pilihanMenu == 'edit' ? '' : '' }}">
                                                    Edit produk
                                                </button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn btn-hapus {{ $pilihanMenu == 'hapus' ? '' : '' }}">
                                                    Hapus produk
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary">
                        <div class="card-header">
                            Tambah Produk
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='simpan'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama' />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Kode / Barcode</label>
                                <input type="text" class="form-control" wire:model='kode' />
                                @error('kode')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Harga</label>
                                <input type="text" class="form-control" wire:model='harga' />
                                @error('harga')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model='stok' />
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Gambar Produk (belum bisa digunakan)</label>
                                <input type="file" class="form-control" wire:model='gambar' accept="image/*" />
                                @error('gambar')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror


                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit Produk
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='simpanEdit'>
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model='nama' />
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Kode / Barcode</label>
                                <input type="text" class="form-control" wire:model='kode' />
                                @error('kode')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model='harga' />
                                @error('harga')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model='stok' />
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror

                                <button type="submit" class="btn btn-warning mt-2">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            Hapus Produk
                        </div>
                        <div class="card-body">
                            Anda yakin akan menghapus produk ini?
                            <p><strong>Kode:</strong> {{ $produkTerpilih->kode }}</p>
                            <p><strong>Nama:</strong> {{ $produkTerpilih->nama }}</p>
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-secondary" wire:click='batal'>Batal</button>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'excel')
                    <div class="card border-secondary">
                        <div class="card-header bg-success text-white">
                            Import Produk (fitur ini masih dalam tahap pengembangan)
                        </div>
                        <div class="card-body">
                            <form wire:submit='importExcel'>
                                <input type="file" class="form-control" wire:model='fileExcell' />
                                <br />
                                <button class="btn btn-success" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
