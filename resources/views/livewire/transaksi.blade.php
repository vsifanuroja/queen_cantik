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


                    <h4 class="card-title">Kasir: {{ $kasir->name ?? 'Tidak diketahui' }}</h4>


                    <input type="text" class="form-control" placeholder="No. Invoice" wire:model.lazy="kode">
                    <table class="table table-bordered mt-2">

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
                                        <td>
                                            <button class="btn btn-sm btn-secondary" wire:click="tambahJumlah({{ $produk->id }})">+</button>
                                            {{ $produk->jumlah }}
                                            <button class="btn btn-sm btn-secondary" wire:click="kurangiJumlah({{ $produk->id }})">-</button>
                                        </td>
                                        <td>@money($produk->produk->harga * $produk->jumlah)</td>

                                        <td>
                                            <button class="btn btn-danger" wire:click="hapusProduk({{ $produk->id }})"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                Hapus
                                            </button>

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
                    <!-- Tambahkan wire:model.live agar input diperbarui ke Livewire -->
                    <input type="number" class="form-control" placeholder="Masukkan Nominal" wire:model.live="bayar">
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
            <button class="btn btn-primary mt-3" wire:click="printNota">Cetak Nota</button>

        </div>
    </div>
    @endif
</div>
