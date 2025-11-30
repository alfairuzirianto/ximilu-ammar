<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .text-right { text-align: right; }
        .total { font-weight: bold; background-color: #f9f9f9; }
        .summary-box { border: 1px solid #ddd; padding: 15px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Ximilu Ammar</h2>
        <h3>{{ $title }}</h3>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    </div>

    @if($type == 'penjualan')
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_invoice }}</td>
                    <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="3" class="text-right">Total Penjualan:</td>
                    <td class="text-right">Rp {{ number_format($data->sum('total'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

    @elseif($type == 'pengeluaran')
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_invoice }}</td>
                    <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->supplier->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="5" class="text-right">Total Pengeluaran:</td>
                    <td class="text-right">Rp {{ number_format($data->sum('total'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

    @elseif($type == 'laba-rugi')
        <div class="summary-box">
            <p><strong>Total Penjualan:</strong> Rp {{ number_format($data['penjualan'], 0, ',', '.') }}</p>
            <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</p>
            <hr>
            <p><strong>{{ $data['laba'] >= 0 ? 'Laba' : 'Rugi' }}:</strong> Rp {{ number_format(abs($data['laba']), 0, ',', '.') }}</p>
        </div>

    @elseif($type == 'arus-kas')
        <div class="summary-box">
            <p><strong>Pemasukan (Penjualan):</strong> Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</p>
            <p><strong>Pengeluaran (Dibayar):</strong> Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</p>
            <hr>
            <p><strong>Saldo Kas:</strong> Rp {{ number_format($data['saldo'], 0, ',', '.') }}</p>
        </div>

    @elseif($type == 'utang')
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Supplier</th>
                    <th class="text-right">Total</th>
                    <th class="text-right">Dibayar</th>
                    <th class="text-right">Sisa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['expense']->kode_invoice }}</td>
                    <td>{{ $item['expense']->supplier->nama ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($item['expense']->total, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item['expense']->totalPaid(), 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item['sisa'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="5" class="text-right">Total Utang:</td>
                    <td class="text-right">Rp {{ number_format($data->sum('sisa'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>