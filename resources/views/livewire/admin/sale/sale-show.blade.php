<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Invoice Penjualan</h2>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.sales.invoice-pdf', $sale->id) }}" target="_blank" class="btn btn-danger">
        <iconify-icon icon="solar:download-linear" width="20"></iconify-icon> Download PDF
      </a>
      <a href="{{ route('admin.sales.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
    </div>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <div class="row mb-4">
        <div class="col-md-6">
          <h3 class="fw-bold text-primary">Ximilu Ammar</h3>
          <p class="text-muted mb-0">Sistem Manajemen UMKM</p>
        </div>
        <div class="col-md-6 text-end">
          <h5>INVOICE PENJUALAN</h5>
          <p class="mb-1"><strong>{{ $sale->kode_invoice }}</strong></p>
          <p class="text-muted">{{ $sale->tanggal->format('d F Y') }}</p>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <h6 class="fw-bold">Metode Pembayaran:</h6>
          <span class="badge bg-primary">{{ $sale->metode_pembayaran }}</span>
        </div>
      </div>

      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th class="text-end">Harga</th>
            <th class="text-end">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sale->details as $index => $detail)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $detail->product->nama }}</td>
            <td>{{ $detail->jumlah }} {{ $detail->product->satuan }}</td>
            <td class="text-end">Rp {{ number_format($detail->product->harga_satuan, 0, ',', '.') }}</td>
            <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
          </tr>
          @endforeach
          <tr class="fw-bold">
            <td colspan="4" class="text-end">TOTAL:</td>
            <td class="text-end">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
          </tr>
        </tbody>
      </table>

      <div class="text-center mt-4 pt-4 border-top">
        <p class="text-muted mb-0">Terima kasih atas kepercayaan Anda</p>
      </div>
    </div>
  </div>
</div>