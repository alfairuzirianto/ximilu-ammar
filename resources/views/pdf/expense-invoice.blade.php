<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $expense->kode_invoice }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .info { margin: 20px 0; }
        .info-row { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; font-weight: bold; }
        .text-right { text-align: right; }
        .total { font-weight: bold; background-color: #f9f9f9; font-size: 14px; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0; color: #DA7326;">Ximilu Ammar</h2>
        <p style="margin: 5px 0;">Sistem Manajemen UMKM</p>
    </div>

    <h3 style="text-align: center;">INVOICE PENGELUARAN</h3>

    <div class="info">
        <div class="info-row"><strong>Invoice:</strong> {{ $expense->kode_invoice }}</div>
        <div class="info-row"><strong>Tanggal:</strong> {{ $expense->tanggal->format('d F Y') }}</div>
        <div class="info-row"><strong>Kategori:</strong> {{ $expense->kategori }}</div>
        @if($expense->supplier)
        <div class="info-row"><strong>Supplier:</strong> {{ $expense->supplier->nama }}</div>
        <div class="info-row"><strong>Telepon:</strong> {{ $expense->supplier->telepon }}</div>
        <div class="info-row"><strong>Alamat:</strong> {{ $expense->supplier->alamat }}</div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Deskripsi</th>
                <th style="width: 10%;">Jumlah</th>
                <th class="text-right" style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expense->details as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->supplierItem->nama ?? $detail->deskripsi }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="3" class="text-right">TOTAL:</td>
                <td class="text-right">Rp {{ number_format($expense->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h4>Riwayat Pembayaran:</h4>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Metode</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expense->payments as $payment)
            <tr>
                <td>{{ $payment->tanggal->format('d M Y') }}</td>
                <td>{{ $payment->metode }}</td>
                <td class="text-right">Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align: center; color: #999;">Belum ada pembayaran</td></tr>
            @endforelse
            @if($expense->payments->count())
            <tr class="total">
                <td colspan="2" class="text-right">Total Dibayar:</td>
                <td class="text-right">Rp {{ number_format($expense->totalPaid(), 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td colspan="2" class="text-right">Sisa Tagihan:</td>
                <td class="text-right">Rp {{ number_format($expense->sisaTagihan(), 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem</p>
    </div>
</body>
</html>