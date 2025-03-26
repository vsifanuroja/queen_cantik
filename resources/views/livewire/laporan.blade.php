<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laporan Transaksi</h4>

                    <!-- Form Filter -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="bulan">Pilih Bulan:</label>
                            <input type="month" wire:model="bulan" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="tanggal_mulai">Dari Tanggal:</label>
                            <input type="date" wire:model.defer="tanggal_mulai" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="tanggal_selesai">Sampai Tanggal:</label>
                            <input type="date" wire:model.defer="tanggal_selesai" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button wire:click="$refresh" class="btn btn-secondary w-100">Filter</button>
                        </div>
                    </div>

                    <a href="{{ url('/cetak') }}" target="_blank" class="btn btn-primary">Cetak</a>

                    <table class="table table-bordered mt-3">
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
                                <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                                <td>{{ $transaksi->kode }}</td>
                                <td>{{ $transaksi->kasir?->name }}</td>
                                <td>{{ number_format($transaksi->total, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
