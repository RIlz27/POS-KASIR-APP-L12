@extends('layouts.app')

@section('content')
<div class="container">
     <div class="card border-primary">
                    <div class="card-header">
                        Tambah Pengguna
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpan'>
                            <label>Nama</label>
                            <input type="text" class="form-control" wire:model='nama'/>
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror

                            <label>Email</label>
                            <input type="email" class="form-control" wire:model='email'/>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror

                            <label>Password</label>
                            <input type="password" class="form-control" wire:model='password'/>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror

                            <label>Peran</label>
                            <select type="text" class="form-control" wire:model='peran'>
                                <option>Pilih Peran</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('peran')
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror

                            <button type="submit" class="btn btn-primary mt-2   ">Simpan</button>
                        </form>
                    </div>
                </div>
</div>
@endsection
