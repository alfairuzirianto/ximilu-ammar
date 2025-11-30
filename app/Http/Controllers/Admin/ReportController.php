<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportPdf($type, $startDate, $endDate)
    {
        $data = [];
        $title = '';

        switch ($type) {
            case 'penjualan':
                $title = 'Laporan Penjualan';
                $data = Sale::whereBetween('tanggal', [$startDate, $endDate])->get();
                break;
            case 'pengeluaran':
                $title = 'Laporan Pengeluaran';
                $data = Expense::with('supplier')->whereBetween('tanggal', [$startDate, $endDate])->get();
                break;
            case 'laba-rugi':
                $title = 'Laporan Laba Rugi';
                $penjualan = Sale::whereBetween('tanggal', [$startDate, $endDate])->sum('total');
                $pengeluaran = Expense::whereBetween('tanggal', [$startDate, $endDate])->sum('total');
                $data = [
                    'penjualan' => $penjualan,
                    'pengeluaran' => $pengeluaran,
                    'laba' => $penjualan - $pengeluaran,
                ];
                break;
            case 'arus-kas':
                $title = 'Laporan Arus Kas';
                $pemasukan = Sale::whereBetween('tanggal', [$startDate, $endDate])->sum('total');
                $pengeluaran = Payment::whereBetween('tanggal', [$startDate, $endDate])->sum('nominal');
                $data = [
                    'pemasukan' => $pemasukan,
                    'pengeluaran' => $pengeluaran,
                    'saldo' => $pemasukan - $pengeluaran,
                ];
                break;
            case 'utang':
                $title = 'Laporan Utang';
                $data = Expense::where('status', '!=', 'lunas')
                    ->with(['supplier', 'payments'])
                    ->get()
                    ->map(function($expense) {
                        return [
                            'expense' => $expense,
                            'sisa' => $expense->sisaTagihan()
                        ];
                    });
                break;
        }

        $pdf = Pdf::loadView('pdf.report', [
            'title' => $title,
            'type' => $type,
            'data' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream("laporan-{$type}-" . date('Ymd') . ".pdf");
    }
}
