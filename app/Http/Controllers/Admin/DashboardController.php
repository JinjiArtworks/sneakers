<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $ordersComplete = Order::where('status','=','Selesai')->get();
        $users = Auth::user()->id;

        // Total Pesanan
        $totalSalesOrders = Order::count();

        // Total Pesanan Berhasil
        $totalCompleteOrders = Order::where('status', '=', 'Selesai')->count();
        $getClients = DB::table('pesanans')
            ->select('users_id')
            ->groupBy('users_id')
            ->get();
        $totalClients = $getClients->count();

        // Total Products Tersedia pada toko
        $getTotalProducts = Product::count();

        // Hitung Pendapatan Bersih
        $checkOrdersComplete = Order::where('status', '=', 'Selesai')->orWhere('status','=','Ajuan Pengembalian Ditolak')->get();
        $countPendapatanTotal = collect($checkOrdersComplete)->sum('total');
        $countOngkosKirim = collect($checkOrdersComplete)->sum('ongkos_kirim');
        $pendapatanBersih = $countPendapatanTotal - $countOngkosKirim;

        return view('admin.listReport.dashboard', compact('orders', 'totalSalesOrders','ordersComplete', 'totalClients', 'pendapatanBersih', 'totalCompleteOrders','getTotalProducts'));
    }
    public function detail($id)
    {
        $orderdetails = OrderDetail::whereOrderId($id)->get(); 
        $orders = Order::find($id);
        // return dd($orders->nama);

        // $details = OrderDetail::whereOrderId($id)->get(); // already declated a has many from categories, its mean it is beloangsto categories
        // {{ $item->order->status }}

        // $returnOrder = Returns::whereOrdersId($id)->first();
        return view('admin.listReport.dashboard-details', compact('orderdetails','orders'));
    }
    public function update($id)
    {
        Order::where('id', $id)
            ->update(
                [
                    'status' => 'Pesanan Dikirim',
                ]
            );
        return redirect('/admin-dashboard')->with('success', 'Pesanan Berhasil Dikirim');
    }
    public function updateReturn(Request $request, $id)
    {
        Order::where('id', $id)
            ->update(
                [
                    'status' => $request->action,
                ]
            );
        return redirect('/data-reports')->with('success', 'Status Pesanan Berhasil Diubah');
    }
    public function updateCustom(Request $request, $id)
    {
        Order::where('id', $id)
            ->update(
                [
                    'status' => $request->action,
                ]
            );
        return redirect('/data-reports')->with('success', 'Status Pesanan Berhasil Diubah');
    }
}
