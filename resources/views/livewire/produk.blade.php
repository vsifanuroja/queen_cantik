<div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">Semua Produk</button>

                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">Tambah Produk</button>

                <button wire:click="pilihMenu('excel')"
                    class="btn {{ $pilihanMenu == 'excel' ? 'btn-primary' : 'btn-outline-primary' }}">Import Produk</button>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kode Barcode</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Barcode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->kode }}</td>
                                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td>
                                        @if($produk->kode)
                                            {!! QrCode::size(100)->generate($produk->kode) !!}
                                        @else
                                            <span class="text-danger">Tidak ada kode</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="pilihEdit({{ $produk->id }})"
                                            class="btn btn-warning">Edit</button>

                                        <button wire:click="pilihHapus({{ $produk->id }})"
                                            class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                <div wire:loading class="text-info">Loading...</div>

                @endif
            </div>
        </div>
    </div>
</div>
