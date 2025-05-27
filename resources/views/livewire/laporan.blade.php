<div>
    <div class="container" style="margin-right: -40px;">
        <div class="row mt-3">
            <div class="col-10">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Penjualan</h5>
                        <a href="{{ url('/cetak') }}" target="_blank" >Cetak</a>
                        <table class="table table-bordered ">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No Inv.</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaTransaksi as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->created_at }}</td>
                                        <td>{{ $transaksi->kode }}</td>
                                        <td>Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
