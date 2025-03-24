<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Nota Transaksi</h2>
    <p><strong>No. Invoice:</strong> {{ $transaksi->kode }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detilTransaksi as $index => $detil)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detil->produk->nama }}</td>
                <td>{{ number_format($detil->produk->harga, 2, ',', '.') }}</td>
                <td>{{ $detil->jumlah }}</td>
                <td>{{ number_format($detil->jumlah * $detil->produk->harga, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total: Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</h3>
</body>
</html>
