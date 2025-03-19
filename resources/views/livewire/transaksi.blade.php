<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            @if(!$transaksiAktif)
                <button class="btn btn-primary" wire:click='transaksiBaru'>Transaksi Baru</button>
            @endif

            @if($transaksiAktif)
                <button class="btn btn-danger" wire:click='batalTransaksi'>Batalkan Transaksi</button>
            @endif

            <button class="btn btn-info" wire:loading>Sedang Loading...</button>
        </div>
    </div>

    @if($transaksiAktif)
    <!-- Tampilan ini hanya muncul jika transaksi aktif -->
    <div class="row mt-3">
        <div class="col">
            <div class="card border-primary">
                <div class="card-body">
                    <h4 class="card-title">No Invoice : {{ $transaksiAktif->kode }}</h4>
                    <input type="text" class="form-control" placeholder="No. Invoice" wire:model="kode">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->produk->kode }}</td>
                                <td>{{ $produk->produk->nama }}</td>
                                <td>{{ number_format($produk->produk->harga, 2, ',', '.') }}</td>
                                <td>{{ $produk->jumlah }}</td>
                                <td>{{ number_format($produk->produk->harga * $produk->jumlah, 2, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-danger" wire:click="hapusProduk({{ $produk->id }})">Hapus</button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Biaya</h5>
                    <div class="d-flex justify-content-between">
                        <span>Rp.</span>
                        <span>{{ number_format($totalSemuaBelanja, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="card border-primary mt-2">
                <div class="card-body">
                    <h4 class="card-title">Bayar</h4>
                    <input type="number" class="form-control" placeholder="Masukkan Nominal" wire:model="bayar">
                </div>
            </div>

            <div class="card border-primary mt-2">
                <div class="card-body">
                    <h5 class="card-title">Kembalian</h5>
                    <div class="d-flex justify-content-between">
                        <span>Rp.</span>
                        <span>{{ number_format($kembalian, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if ($bayar >= $totalSemuaBelanja)
                <button class="btn btn-success mt-3 w-100" wire:click="transaksiSelesai">Bayar</button>
            @elseif ($bayar > 0 && $bayar < $totalSemuaBelanja)
                <div class="alert alert-danger mt-2">Uang kurang</div>
            @endif
        </div>
    </div>
    @endif
</div>
