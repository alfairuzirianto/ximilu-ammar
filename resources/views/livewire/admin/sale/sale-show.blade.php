<div>
  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="dashboard-title mb-1">Invoice Penjualan</h2>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.sales.invoice-pdf', $sale->id) }}" target="_blank" class="btn btn-brown d-flex align-items-center gap-1">
        <iconify-icon icon="solar:download-linear" width="20"></iconify-icon> Download PDF
      </a>
      <a href="{{ route('admin.sales.index') }}" wire:navigate class="btn btn-light-brown">Kembali</a>
    </div>
  </div>

  <!-- CARD INVOICE -->
  <div class="card-custom p-4">
    <div class="row mb-4">
      <div class="col-md-6">
        <h3 class="fw-bold text-brown">Ximilu Ammar</h3>
        <p class="text-muted mb-0">Sistem Manajemen UMKM</p>
      </div>
      <div class="col-md-6 text-end">
        <h5 class="fw-semibold">INVOICE PENJUALAN</h5>
        <p class="mb-1"><strong>{{ $sale->kode_invoice }}</strong></p>
        <p class="text-muted">{{ $sale->tanggal->format('d F Y') }}</p>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6">
        <h6 class="fw-bold">Metode Pembayaran:</h6>
        <span class="badge badge-brown">{{ $sale->metode_pembayaran }}</span>
      </div>
    </div>

    <!-- TABLE DETAIL -->
    <div class="table-responsive">
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
            <td class="text-end text-brown">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="text-center mt-4 pt-4 border-top">
      <p class="text-muted mb-0">Terima kasih atas kepercayaan Anda</p>
    </div>
  </div>
</div>

@push('styles')
<style>
.card-custom {
    background: #fff;
    border-radius: 14px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.2s ease;
}
.card-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}
.btn-brown {
    background: #d27b35;
    color: #fff !important;
    border-radius: 10px;
    border: none;
}
.btn-brown:hover {
    background: #bb6e2f;
    color: #fff !important;
}
.btn-light-brown {
    background: #f5e9d7;
    color: #5a4637;
    border-radius: 10px;
    border: none;
}
.badge-brown {
    background: #d27b35;
    color: white;
}
.text-brown {
    color: #d27b35 !important;
}
.dashboard-title {
    font-weight: 800;
    font-size: 26px;
    color: #5a4637;
}
</style>
@endpush
