<div>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 section-title">{{ $supplier->nama }}</h2>
            <p class="text-muted mb-0">Detail pemasok dan barang</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.expenses.create', ['supplier_id' => $supplier->id]) }}"
               wire:navigate class="btn btn-brown d-flex align-items-center gap-1 px-3">
                <iconify-icon icon="solar:cart-large-2-linear" width="20"></iconify-icon>
                Pesan Barang
            </a>

            <a href="{{ route('admin.suppliers.index') }}" wire:navigate
               class="btn btn-light-brown px-3">
                Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- INFORMASI SUPPLIER -->
        <div class="col-md-4">
            <div class="card-custom p-3">
                <h5 class="fw-bold mb-3 section-title">Informasi Pemasok</h5>

                <div class="mb-2 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:phone-linear" width="18"></iconify-icon>
                    {{ $supplier->telepon }}
                </div>

                <div class="mb-2 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:letter-linear" width="18"></iconify-icon>
                    {{ $supplier->email }}
                </div>

                <div class="d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:map-point-linear" width="18"></iconify-icon>
                    {{ $supplier->alamat }}
                </div>
            </div>
        </div>

        <!-- LIST ITEM -->
        <div class="col-md-8">
            <div class="card-custom">

                <div class="p-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 section-title">Daftar Barang</h5>

                    <button wire:click="openItemModal" class="btn btn-brown btn-sm">
                        <iconify-icon icon="mingcute:add-fill"></iconify-icon>
                        Tambah Item
                    </button>
                </div>

                <div class="table-responsive p-2">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Nama Item</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th width="100">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td><span class="badge bg-light text-dark">{{ $item->satuan }}</span></td>
                                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>

                                <td class="d-flex gap-1">
                                    <button wire:click="openItemModal({{ $item->id }})"
                                            class="btn btn-sm btn-light-brown">
                                        <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                    </button>

                                    <button wire:click="deleteItem({{ $item->id }})"
                                            class="btn btn-sm btn-light text-danger">
                                        <iconify-icon icon="solar:trash-bin-minimalistic-linear"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada item</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- RIWAYAT PEMBELIAN -->
    <div class="card-custom mt-4 p-3">
        <h5 class="mb-3 section-title">Riwayat Pembelian</h5>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                <tr>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Dibayar</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @forelse($expenses as $exp)
                    <tr>
                        <td>
                            <a href="{{ route('admin.expenses.show', $exp->id) }}"
                               wire:navigate class="text-decoration-none">
                                {{ $exp->kode_invoice }}
                            </a>
                        </td>

                        <td>{{ $exp->tanggal->format('d M Y') }}</td>
                        <td>Rp {{ number_format($exp->total, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($exp->totalPaid(), 0, ',', '.') }}</td>

                        <td>
                            @if($exp->isLunas())
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-warning">Belum Lunas</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH/EDIT ITEM -->
    @if($showItemModal)
        <div class="modal fade show d-block" style="background:rgba(0,0,0,.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">

                    <div class="modal-header">
                        <h5 class="modal-title section-title">
                            {{ $itemId ? 'Edit' : 'Tambah' }} Item
                        </h5>
                        <button type="button" class="btn-close"
                                wire:click="$set('showItemModal', false)"></button>
                    </div>

                    <form wire:submit="saveItem">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Nama Item</label>
                                <input type="text" wire:model="nama"
                                       class="form-control @error('nama') is-invalid @enderror">
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Satuan</label>
                                <select wire:model="satuan"
                                        class="form-select @error('satuan') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                                @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" wire:model="harga_satuan"
                                       class="form-control @error('harga_satuan') is-invalid @enderror">
                                @error('harga_satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-brown"
                                    wire:click="$set('showItemModal', false)">Batal</button>

                            <button type="submit" class="btn btn-brown px-4">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif

</div>

@push('styles')
<style>
    body {
        background: #f5e9d7 !important;
    }
    .card-custom {
        background: #fff;
        border-radius: 14px;
        border: none;
        padding: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .section-title {
        color: #5a4637;
        font-weight: 700;
    }
    .btn-brown {
        background: #d27b35;
        color: #fff;
        border-radius: 10px;
        border: none;
    }
    .btn-brown:hover {
        background: #bb6e2f;
        color: #fff;
    }
    .btn-light-brown {
        background: #f5e9d7;
        color: #5a4637;
        border-radius: 10px;
        border: none;
    }
</style>
@endpush
