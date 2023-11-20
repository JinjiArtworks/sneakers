<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\AdminValidationOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardSellerController extends Controller
{
    public function index($idSellers)
    {
        // $orders = Order::whereUsersId($idSellers)->where('status', '=', 'Proses Validasi Admin')->get();
        $userId = Auth::user()->id;
        if ($userId == $idSellers) {
            $orders = Order::whereSellersId($userId)->get();
            // dd($orders->orderdetail->product->images);
            $sellerProducts = ProductSeller::whereUserId($idSellers)->get();
            // dd($sellerProducts);
            $totalSalesOrders = Order::count();

            // Total Pesanan Berhasil
            $totalCompleteOrders = Order::where('status', '=', 'Selesai')->count();
            $getClients = DB::table('orders')
                ->select('users_id')
                ->groupBy('users_id')
                ->get();
            $totalClients = $getClients->count();

            // Total Products Tersedia pada toko
            $getTotalProducts = Product::count();

            // Hitung Pendapatan Bersih
            $checkOrdersComplete = Order::where('status', '=', 'Selesai')->orWhere('status', '=', 'Ajuan Pengembalian Ditolak')->get();
            $countPendapatanTotal = collect($checkOrdersComplete)->sum('total');
            $countOngkosKirim = collect($checkOrdersComplete)->sum('ongkos_kirim');
            $pendapatanBersih = $countPendapatanTotal - $countOngkosKirim;

            return view('sellers.index', compact('orders', 'sellerProducts', 'totalSalesOrders', 'totalClients', 'pendapatanBersih', 'totalCompleteOrders', 'getTotalProducts'));
        } else {
            return redirect('/');
        }
    }
    // public function detailProducts($id)
    // {
    //     $orderdetails = ProductSeller::find($id)->first();
    //     return view('admin.listReport.dashboard-details', compact('orderdetails', 'orders'));
    // }
    public function detailListOrder($id)
    {
        $userId = Auth::user()->id;
        $orderDetails = OrderDetail::whereOrderId($id)->get();
        $getOrderDetailsStatus = OrderDetail::whereOrderId($id)->first();
        // dd($orderDetails);

        return view('sellers.detail-order', compact('orderDetails','userId','getOrderDetailsStatus'));
    }
    public function updateListOrder(Request $request, $id)
    {
        $idSeller = Auth::user()->id;
        // dd($request->all());
        if ($request->resiImage != null) {
            $destinationPath = '/img/list';
            $request->resiImage->move(public_path($destinationPath), $request->resiImage->getClientOriginalName());
            AdminValidationOrder::create([
                'resi_number' => $request->resiNumber,
                'resi_images' => $request->resiImage->getClientOriginalName(),
                'order_id' => $id,
            ]);
            Order::where('id', $id)
                ->update(
                    [
                        'status' => 'Pesanan Dikirim Kepada Admin',
                    ]
                );
        }
        return redirect('seller-dashboard/' . $idSeller)->with('success', 'Pesanan Berhasil Dikirim');
    }

    public function removeProduct($id)
    {
        ProductSeller::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product berhasil dihapus.');
    }
    // public function updateReturn(Request $request, $id)
    // {
    //     Order::where('id', $id)
    //         ->update(
    //             [
    //                 'status' => $request->action,
    //             ]
    //         );
    //     return redirect('/data-reports')->with('success', 'Status Pesanan Berhasil Diubah');
    // }
    // public function updateCustom(Request $request, $id)
    // {
    //     Order::where('id', $id)
    //         ->update(
    //             [
    //                 'status' => $request->action,
    //             ]
    //         );
    //     return redirect('/data-reports')->with('success', 'Status Pesanan Berhasil Diubah');
    // }
}
