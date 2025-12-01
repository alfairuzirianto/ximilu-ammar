<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">{{ isset($saleId) ? 'Edit' : 'Tambah' }} Penjualan</h2>
    <a href="{{ route('admin.sales.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
  </div>

  <form wire:submit="{{ isset($saleId) ? 'update' : 'save' }}">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Kode Invoice</label>
              <input type="text" wire:model="kode_invoice" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal</label>
              <input type="date" wire:model="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
              @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Metode</label>
              <select wire:model="metode" class="form-select">
                @foreach(\App\Models\Sale::METODE as $m)
                <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Penjualan</h5>
            <button type="button" wire:click="addDetail" class="btn btn-sm btn-primary">
              <iconify-icon icon="mingcute:add-fill"></iconify-icon> Tambah Item
            </button>
          </div>
          <div class="card-body">
            @foreach($details as $index => $detail)
            <div class="border rounded p-3 mb-3">
              <div class="d-flex justify-content-between mb-2">
                <h6 class="mb-0">Item #{{ $index + 1 }}</h6>
                <button type="button" wire:click="removeDetail({{ $index }})" class="btn btn-sm btn-light text-danger">
                  <iconify-icon icon="solar:trash-bin-minimalistic-linear"></iconify-icon>
                </button>
              </div>
              <div class="row">
                <div class="col-md-6 mb-2">
                  <label class="form-label">Produk</label>
                  <select wire:model="details.{{ $index }}.product_id" wire:change="calculateSubtotal({{ $index }})" class="form-select @error('details.{{ $index }}.product_id') is-invalid @enderror">
                    <option value="">Pilih Produk</option>
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }} - Rp {{ number_format($p->harga_satuan, 0, ',', '.') }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 mb-2">
                  <label class="form-label">Jumlah</label>
                  <input type="number" wire:model="details.{{ $index }}.jumlah" wire:change="calculateSubtotal({{ $index }})" class="form-control @error('details.{{ $index }}.jumlah') is-invalid @enderror">
                </div>
                <div class="col-md-3 mb-2">
                  <label class="form-label">Subtotal</label>
                  <input type="number" wire:model="details.{{ $index }}.subtotal" class="form-control" readonly>
                </div>
              </div>
            </div>
            @endforeach
            
            <div class="border-top pt-3 mt-3">
              <div class="d-flex justify-content-between">
                <h5>Total:</h5>
                <h5 class="text-primary">Rp {{ number_format(collect($details)->sum('subtotal'), 0, ',', '.') }}</h5>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3" wire:loading.attr="disabled">
          <span wire:loading.remove><iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($saleId) ? 'Update' : 'Simpan' }}</span>
          <span wire:loading><span class="spinner-border spinner-border-sm"></span> Menyimpan...</span>
        </button>
      </div>
    </div>
  </form>
</div>