<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $sale->kode_invoice }}</title>
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

    <h3 style="text-align: center;">INVOICE PENJUALAN</h3>

    <div class="info">
        <div class="info-row"><strong>Invoice:</strong> {{ $sale->kode_invoice }}</div>
        <div class="info-row"><strong>Tanggal:</strong> {{ $sale->tanggal->format('d F Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Produk</th>
                <th style="width: 15%;">Jumlah</th>
                <th class="text-right" style="width: 15%;">Harga</th>
                <th class="text-right" style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->details as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->product->nama }}</td>
                <td>{{ $detail->jumlah }} {{ $detail->product->satuan }}</td>
                <td class="text-right">Rp {{ number_format($detail->product->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" class="text-right">TOTAL:</td>
                <td class="text-right">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda</p>
        <p>Dokumen ini digenerate otomatis oleh sistem</p>
    </div>
</body>
</html>