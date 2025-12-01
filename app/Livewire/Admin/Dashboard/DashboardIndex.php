<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardIndex extends Component
{
    public function render()
    {
        // Stats Cards
        $totalProduk = Product::count();
        $totalPemasok = Supplier::count();
        $penjualanHariIni = Sale::whereDate('tanggal', today())->sum('total');
        $pengeluaranHariIni = Expense::whereDate('tanggal', today())->sum('total');

        // Arus Kas 7 Hari Terakhir
        $arusKas = collect(range(6, 0))->map(function($day) {
            $date = today()->subDays($day);
            return [
                'date' => $date->format('d M'),
                'pemasukan' => Sale::whereDate('tanggal', $date)->sum('total'),
                'pengeluaran' => Payment::whereDate('tanggal', $date)->sum('nominal'),
            ];
        });

        // Pengeluaran per Kategori 7 Hari
        $pengeluaranKategori = Expense::whereBetween('tanggal', [today()->subDays(6), today()])
            ->select('kategori', DB::raw('SUM(total) as total'))
            ->groupBy('kategori')
            ->get();

        // Status Pembayaran Supplier
        $statusPembayaran = [
            'lunas' => Expense::where('status', 'lunas')->count(),
            'belum_lunas' => Expense::where('status', 'belum lunas')->count(),
        ];

        // Top Produk Terjual
        $topProduk = DB::table('sale_details')
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.nama', DB::raw('SUM(sale_details.jumlah) as total'))
            ->groupBy('products.id', 'products.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('livewire.admin.dashboard.dashboard-index', [
            'totalProduk' => $totalProduk,
            'totalPemasok' => $totalPemasok,
            'penjualanHariIni' => $penjualanHariIni,
            'pengeluaranHariIni' => $pengeluaranHariIni,
            'arusKas' => $arusKas,
            'pengeluaranKategori' => $pengeluaranKategori,
            'statusPembayaran' => $statusPembayaran,
            'topProduk' => $topProduk,
        ]);
    }
}
