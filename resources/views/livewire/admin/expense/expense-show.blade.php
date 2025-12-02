<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Invoice Pengeluaran</h2>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.expenses.invoice-pdf', $expense->id) }}" target="_blank" class="btn btn-danger">
        <iconify-icon icon="solar:download-linear" width="20"></iconify-icon> Download PDF
      </a>
      @if($expense->status != 'lunas')
      <button wire:click="openPaymentModal" class="btn btn-success">
        <iconify-icon icon="solar:wallet-linear" width="20"></iconify-icon> Bayar
      </button>
      @endif
      <a href="{{ route('admin.expenses.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
    </div>
  </div>

  <!-- Invoice Preview -->
  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <div class="row mb-4">
        <div class="col-md-6">
          <h3 class="fw-bold text-primary">Ximilu Ammar</h3>
          <p class="text-muted mb-0">Sistem Manajemen UMKM</p>
        </div>
        <div class="col-md-6 text-end">
          <h5>INVOICE PENGELUARAN</h5>
          <p class="mb-1"><strong>{{ $expense->kode_invoice }}</strong></p>
          <p class="text-muted">{{ $expense->tanggal->format('d F Y') }}</p>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <h6 class="fw-bold">Supplier:</h6>
          <p class="mb-0">{{ $expense->supplier->nama ?? '-' }}</p>
          @if($expense->supplier)
          <p class="mb-0 text-muted">{{ $expense->supplier->telepon }}</p>
          <p class="mb-0 text-muted">{{ $expense->supplier->alamat }}</p>
          @endif
        </div>
        <div class="col-md-6">
          <h6 class="fw-bold">Kategori:</h6>
          <span class="badge bg-light text-dark">{{ $expense->kategori }}</span>
        </div>
      </div>

      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th class="text-end">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($expense->details as $index => $detail)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $detail->supplierItem->nama ?? $detail->deskripsi }}</td>
            <td>{{ $detail->jumlah }}</td>
            <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
          </tr>
          @endforeach
          <tr class="fw-bold">
            <td colspan="3" class="text-end">TOTAL:</td>
            <td class="text-end">Rp {{ number_format($expense->total, 0, ',', '.') }}</td>
          </tr>
        </tbody>
      </table>

      <div class="border-top pt-3 mt-3">
        <h6 class="fw-bold mb-3">Riwayat Pembayaran:</h6>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Metode</th>
              <th class="text-end">Nominal</th>
            </tr>
          </thead>
          <tbody>
            @forelse($expense->payments as $payment)
            <tr>
              <td>{{ $payment->tanggal->format('d M Y') }}</td>
              <td>{{ $payment->metode }}</td>
              <td class="text-end">Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center text-muted">Belum ada pembayaran</td></tr>
            @endforelse
            @if($expense->payments->count())
            <tr class="fw-bold">
              <td colspan="2" class="text-end">Total Dibayar:</td>
              <td class="text-end">Rp {{ number_format($expense->totalPaid(), 0, ',', '.') }}</td>
            </tr>
            <tr class="fw-bold text-danger">
              <td colspan="2" class="text-end">Sisa Tagihan:</td>
              <td class="text-end">Rp {{ number_format($expense->sisaTagihan(), 0, ',', '.') }}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Payment Modal -->
  @if($showPaymentModal)
  <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pembayaran</h5>
          <button type="button" class="btn-close" wire:click="$set('showPaymentModal', false)"></button>
        </div>
        <form wire:submit="savePayment">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" wire:model="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
              @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nominal</label>
              <input type="number" wire:model="nominal" class="form-control @error('nominal') is-invalid @enderror">
              <small class="text-muted">Sisa tagihan: Rp {{ number_format($expense->sisaTagihan(), 0, ',', '.') }}</small>
              @error('nominal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Metode Pembayaran</label>
              <select wire:model="metode" class="form-select @error('metode') is-invalid @enderror">
                <option value="">Pilih</option>
                @foreach(\App\Models\Payment::METODE as $m)
                <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
              </select>
              @error('metode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Catatan</label>
              <textarea wire:model="catatan" rows="2" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="$set('showPaymentModal', false)">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
</div>