<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body onload="print()">
    <div class="container" style="margin-right: -40px;">
        <div class="row mt-3">
            <div class="col-10">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Penjualan</h5>
                        <a href="">Cetak</a>
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
</body>

</html>
