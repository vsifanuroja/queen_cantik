<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
</head>
<body>
    <h2>Nota Transaksi</h2>
    <p>No. Invoice: {{ $transaksi->kode }}</p>
    <p>Kasir: {{ $transaksi->kasir->name }}</p>
    <p>Status: {{ ucfirst($transaksi->status) }}</p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detilTransaksi as $index => $detil)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detil->produk->nama }}</td>
                    <td>{{ $detil->jumlah }}</td>
                    <td>Rp {{ number_format($detil->produk->harga, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($detil->jumlah * $detil->produk->harga, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: Rp {{ number_format($transaksi->total, 2, ',', '.') }}</h3>
</body>
</html>
