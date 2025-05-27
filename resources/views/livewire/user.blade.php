<div>

    <div class="container" style="margin-right: -40px">
        <div class="row my-2">
            <div class="col-12">
                <div class="tabs">
                    <button wire:click="pilihMenu('lihat')" class="tab btn {{ $pilihanMenu == 'lihat' ? 'active' : '' }}">
                        Semua Pengguna
                    </button>
                    <button wire:click="pilihMenu('tambah')"
                        class="tab btn {{ $pilihanMenu == 'tambah' ? 'active' : '' }}">
                        Tambah Pengguna
                    </button>
                    <button wire:loading class="tab btn">
                        loading...
                    </button>
                </div>
            </div>
        </div>
        <div class="row garis">
            @if ($pilihanMenu == 'lihat')
                @foreach ($semuaPengguna as $pengguna)
                    <div class="col-md-4 mb-4">
                        <div class="kartu">
                            <img src="{{ asset('icons/Profile.png') }}" class="rounded-circle" alt="User Icon">
                            <h5>{{ $pengguna->name }}</h5>
                            <p>{{ $pengguna->email }}</p>
                            <span class="badge  mb-3">{{ $pengguna->peran }}</span>
                            <div class="d-flex justify-content-center gap-2">
                                <button wire:click="pilihEdit({{ $pengguna->id }})" class="btn btn-edit">
                                    Edit Pengguna
                                </button>
                                <button wire:click="pilihHapus({{ $pengguna->id }})" class="btn btn-hapus">
                                    Hapus Pengguna
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    @elseif ($pilihanMenu == 'tambah')
        <div class="card col-11 ">
            <h5 class="card-header">
                Tambah Pengguna
            </h5>
            <div class="card-body ">
                <form wire:submit='simpan'>
                    <div class="form-box">
                        <div class="form-row">
                            <label>Nama:</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukan Nama" />
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Email:</label>
                            <input type="email" class="form-control" wire:model='email' placeholder="Masukan Email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Password:</label>
                            <input type="password" class="form-control" wire:model='password'
                                placeholder="Masukan Password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Peran:</label>
                            <select type="text" class="form-control" wire:model='peran'>
                                <option>Pilih Peran</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('peran')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-edit" style="width: 100px; height: auto; ">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($pilihanMenu == 'edit')
        <div class="card col-11 ">
            <h5 class="card-header">
                Tambah Pengguna
            </h5>
            <div class="card-body ">
                <form wire:submit='simpanEdit'>
                    <div class="form-box">
                        <div class="form-row">
                            <label>Nama:</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukan Nama" />
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Email:</label>
                            <input type="email" class="form-control" wire:model='email' placeholder="Masukan Email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Password:</label>
                            <input type="password" class="form-control" wire:model='password'
                                placeholder="Masukan Password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label>Peran:</label>
                            <select type="text" class="form-control" wire:model='peran'>
                                <option>Pilih Peran</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('peran')
                                <span class="text-danger">{{ $message }}</span>
                                <br>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-edit" style="width: 100px; height: auto; ">Simpan</button>
                        <button type="button" class="btn btn-edit" style="width: 100px; height: auto; "
                            wire:click='batal'>Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@elseif($pilihanMenu == 'hapus')
    <div class="card col-11">
        <h5 class="card-header ">
            Hapus Pengguna
        </h5>
        <div class="card-body">
            Anda yakin akan menghapus ini?
            <p>Nama : {{ $penggunaTerpilih->name }}</p>
            <button class="btn btn-hapus" style="width: 100px; height: auto; " wire:click='hapus'>Hapus</button>
            <button class="btn btn-hapus" style="width: 100px; height: auto; " wire:click='batal'>Batal</button>
        </div>
    </div>
    @endif
</div>
</div>
</div>

</div>
