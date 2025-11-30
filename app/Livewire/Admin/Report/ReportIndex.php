<?php

namespace App\Livewire\Admin\Report;

use App\Models\Expense;
use App\Models\Payment;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ReportIndex extends Component
{
    public $reportType = 'penjualan';
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = date('Y-m-01');
        $this->endDate = date('Y-m-d');
    }

    public function exportPdf()
    {
        return redirect()->route('admin.reports.export-pdf', [
            'type' => $this->reportType,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }

    public function render()
    {
        $data = [];

        switch ($this->reportType) {
            case 'penjualan':
                $data = Sale::whereBetween('tanggal', [$this->startDate, $this->endDate])
                    ->orderBy('tanggal', 'desc')
                    ->get();
                break;
            case 'pengeluaran':
                $data = Expense::whereBetween('tanggal', [$this->startDate, $this->endDate])
                    ->with('supplier')
                    ->orderBy('tanggal', 'desc')
                    ->get();
                break;
            case 'laba-rugi':
                $penjualan = Sale::whereBetween('tanggal', [$this->startDate, $this->endDate])->sum('total');
                $pengeluaran = Expense::whereBetween('tanggal', [$this->startDate, $this->endDate])->sum('total');
                $data = [
                    'penjualan' => $penjualan,
                    'pengeluaran' => $pengeluaran,
                    'laba' => $penjualan - $pengeluaran,
                ];
                break;
            case 'arus-kas':
                $pemasukan = Sale::whereBetween('tanggal', [$this->startDate, $this->endDate])->sum('total');
                $pengeluaran = Payment::whereBetween('tanggal', [$this->startDate, $this->endDate])->sum('nominal');
                $data = [
                    'pemasukan' => $pemasukan,
                    'pengeluaran' => $pengeluaran,
                    'saldo' => $pemasukan - $pengeluaran,
                ];
                break;
            case 'utang':
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

        return view('livewire.admin.report.report-index', [
            'reportData' => $data
        ]);
    }
}
