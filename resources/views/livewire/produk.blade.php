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
                {{-- Tampilkan Data Produk --}}
                @if($pilihanMenu == 'lihat')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kode Barcode</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->kode }}</td>
                                    <td>{{ $produk->harga }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td>
                                        <button wire:click="pilihEdit({{ $produk->id }})"
                                            class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">Edit</button>

                                        <button wire:click="pilihHapus({{ $produk->id }})"
                                            class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button wire:loading class="btn btn-info">
                        Loading........
                    </button>

                {{-- Form Tambah Produk --}}
                @elseif ($pilihanMenu == 'tambah')
                    <form wire:submit.prevent="simpan">
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
                    </form>

                {{-- Form Edit Produk --}}
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

                {{-- Konfirmasi Hapus Produk --}}
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-primary">
                        <div class="card-header bg-danger text-white">
                            Hapus Produk
                        </div>
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

                    {{-- code excel --}}
                    @elseif ($pilihanMenu == 'excel')
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">Import Produk</div>
                        <div class="card-body">
                            <form wire:submit='imporExcel'>
                                <input type="file" class="form-control" wire:model='fileExcel'>
                                <br>
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
