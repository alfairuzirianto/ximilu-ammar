<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalPemasok = Pemasok::count();
        $transaksiBulanIni = Transaksi::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();
        $stokRendah = Produk::whereRaw('stok <= stok_minimum')->count();
        
        $transaksiTerbaru = Transaksi::with('pemasok')
            ->latest('tanggal')
            ->take(5)
            ->get();
        
        $produkStokRendah = Produk::with('kategori')
            ->whereRaw('stok <= stok_minimum')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPemasok',
            'transaksiBulanIni',
            'stokRendah',
            'transaksiTerbaru',
            'produkStokRendah'
        ));
    }
}
