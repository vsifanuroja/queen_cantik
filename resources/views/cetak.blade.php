<body onload="print()">
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Transaksi</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No. Inv.</th>
                                    <th>Nama Kasir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaTransaksi as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td>{{ $transaksi->kode }}</td>
                                    <td>{{ $transaksi->kasir?->name }}</td>
                                    <td>Rp, {{ number_format($transaksi->total, 2, ',', '.') }}</td>
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
