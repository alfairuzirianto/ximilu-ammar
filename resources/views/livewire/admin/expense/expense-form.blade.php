<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">{{ isset($expenseId) ? 'Edit' : 'Tambah' }} Pengeluaran</h2>
    <a href="{{ route('admin.expenses.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
  </div>

  <form wire:submit="{{ isset($expenseId) ? 'update' : 'save' }}">
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
              <label class="form-label fw-semibold">Kategori</label>
              <select wire:model.live="kategori" class="form-select @error('kategori') is-invalid @enderror">
                <option value="">Pilih</option>
                @foreach(\App\Models\Expense::KATEGORI as $k)
                <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
              </select>
              @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @if($kategori == 'Pembelian Bahan')
            <div class="mb-3">
              <label class="form-label fw-semibold">Supplier</label>
              <select wire:model.live="supplier_id" wire:change="loadSupplierItems" class="form-select">
                <option value="">Pilih</option>
                @foreach($suppliers as $s)
                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
              </select>
            </div>
            @endif
            @isset($expenseId)
            <div class="mb-3">
              <label class="form-label fw-semibold">Status</label>
              <select wire:model="status" class="form-select">
                @foreach(\App\Models\Expense::STATUS as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
              </select>
            </div>
            @endisset
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pengeluaran</h5>
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
                @if($supplier_id && $kategori == 'Pembelian Bahan')
                <div class="col-md-12 mb-2">
                  <label class="form-label">Item</label>
                  <select wire:model="details.{{ $index }}.supplier_item_id" wire:change="calculateSubtotal({{ $index }})" class="form-select">
                    <option value="">Pilih Item</option>
                    @foreach($supplierItems as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->satuan }})</option>
                    @endforeach
                  </select>
                </div>
                @endif
                @if($kategori == 'Pembelian Bahan')
                <div class="col-md-6 mb-2">
                    <label class="form-label">Jumlah</label>
                    <input type="number" wire:model="details.{{ $index }}.jumlah" wire:change="calculateSubtotal({{ $index }})" class="form-control">
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label">Subtotal</label>
                    <input type="number" wire:model="details.{{ $index }}.subtotal" class="form-control" readonly>
                </div>
                @else
                <div class="col-md-12 mb-2">
                  <label class="form-label">Deskripsi</label>
                  <input type="text" wire:model="details.{{ $index }}.deskripsi" class="form-control">
                </div>
                <div class="col-md-12 mb-2">
                    <label class="form-label">Nominal</label>
                    <input type="number" wire:model="details.{{ $index }}.subtotal" class="form-control">
                </div>
                @endif
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
          <span wire:loading.remove><iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($expenseId) ? 'Update' : 'Simpan' }}</span>
          <span wire:loading><span class="spinner-border spinner-border-sm"></span> Menyimpan...</span>
        </button>
      </div>
    </div>
  </form>
</div>