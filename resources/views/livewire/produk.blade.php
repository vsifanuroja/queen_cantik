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
                {{-- Menampilkan Daftar Produk --}}
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
                                        <button wire:click="pilihEdit({{ $produk->id }})" class="btn btn-warning">Edit</button>
                                        <button wire:click="pilihHapus({{ $produk->id }})" class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                {{-- Menampilkan Form Tambah Produk --}}
                @elseif($pilihanMenu == 'tambah')
                    <div class="card">
                        <div class="card-header bg-primary text-white">Tambah Produk</div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpanProduk">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" wire:model="nama" id="nama" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Barcode</label>
                                    <input type="text" wire:model="kode" id="kode" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" wire:model="harga" id="harga" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" wire:model="stok" id="stok" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>

                {{-- Menampilkan Form Edit Produk --}}
                @elseif ($pilihanMenu == 'edit')
                    <form wire:submit.prevent="simpanEdit">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="nama">
                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        <br>

                        <label>Kode Barcode</label>
                        <input type="text" class="form-control" wire:model="kode">
                        @error('kode') <span class="text-danger">{{ $message }}</span> @enderror
                        <br>

                        <label>Harga</label>
                        <input type="number" class="form-control" wire:model="harga">
                        @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                        <br>

                        <label>Stok</label>
                        <input type="number" class="form-control" wire:model="stok">
                        @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                        <br>

                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <button type="button" wire:click="batal" class="btn btn-secondary mt-3">Batal</button>
                    </form>

                {{-- Menampilkan Konfirmasi Hapus Produk --}}
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-primary">
                        <div class="card-header bg-danger text-white">Hapus Produk</div>
                        <div class="card-body">
                            @if($produkTerpilih)
                                <p>Anda yakin ingin menghapus produk ini?</p>
                                <p>Nama: {{ $produkTerpilih->nama }}</p>
                                <button class="btn btn-danger" wire:click="hapus">HAPUS</button>
                                <button class="btn btn-secondary" wire:click="batal">BATAL</button>
                            @else
                                <p class="text-danger">Tidak ada produk yang dipilih.</p>
                            @endif
                        </div>
                    </div>

                {{-- Menampilkan Form Import Produk dari Excel --}}
                @elseif($pilihanMenu == 'excel')
                    <div class="card">
                        <div class="card-header bg-success text-white">Import Produk dari Excel</div>
                        <div class="card-body">
                            <form wire:submit.prevent="importExcel" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Pilih File Excel</label>
                                    <input type="file" wire:model="file" id="file" class="form-control">
                                </div>
                                <button wire:click="importExcel">Import</button>

                            </form>
                        </div>
                    </div>
                @endif

                <div wire:loading class="text-info">Loading...</div>
            </div>
        </div>
    </div>
</div>
