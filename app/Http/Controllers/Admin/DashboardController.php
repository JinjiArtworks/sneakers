<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminValidationOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSeller;
use App\Models\Returns;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::whereStatus('Pesanan Dikirim Kepada Admin')->get();
        // dd($orders);
        $ordersComplete = Order::where('status', '=', 'Selesai')->get();
        $users = Auth::user()->id;

        // Total Pesanan
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

        return view('admin.listReport.dashboard', compact('orders', 'totalSalesOrders', 'ordersComplete', 'totalClients', 'pendapatanBersih', 'totalCompleteOrders', 'getTotalProducts'));
    }

    public function detail($id)
    {
        // $orderID
        $orderdetails = OrderDetail::whereOrderId($id)->get();
        $validations_admin = AdminValidationOrder::whereOrderId($id)->get();
        $orderData = OrderDetail::whereOrderId($id)->first();
        $getSellerId = $orderData->order->sellers_id;
        $getBuyersId = $orderData->order->users_id;
        return view('admin.listReport.dashboard-details', compact('orderData', 'validations_admin', 'orderdetails', 'getSellerId'));
    }
    public function updateConfirmAdmin(Request $request, $id)
    {
        $mytime = Carbon::now()->today()->toDateTimeString();
        $getOrderDetail = OrderDetail::whereOrderId($id)->first();
        $getShippingCost = $getOrderDetail->order->shipping_cost;
        $getTotalPrice = $getOrderDetail->order->total;

        $sellerIdReq = $request->sellerID;
        $sellerID = ProductSeller::whereUserId($sellerIdReq)->first(); // id seller dr table product sller
        $getSellerId = $sellerID->user_id;
        $getSellerSaldo = $sellerID->user->saldo;
        // dd($getSellerSaldo);
        $getAdmin = User::whereRoleId(1)->first();
        // dd($getAdmin->saldo);
        $adminId = $getAdmin->id;
        $adminSaldo = $getAdmin->saldo;

        Order::where('id', $id)
            ->update(
                [
                    'status' => 'Selesai',
                    'updated_at' => $mytime
                ]
            );
        User::where('id', $adminId)
            ->update(
                [
                    // menambahkan biaya layanan admin sebesar 10k
                    'saldo' => $adminSaldo + 10000,
                ]
            );
        User::where('id', $getSellerId)
            ->update(
                [
                    'saldo' => $getSellerSaldo + ($getTotalPrice - $getShippingCost) - 10000,
                ]
            );

        return redirect('/admin-dashboard')->with('success', 'Pesanan Berhasil Dikonfirmasi');
    }
    public function declineOrderAdmin($id)
    {
        $mytime = Carbon::now()->today()->toDateTimeString();
        $getOrderDetail = OrderDetail::whereOrderId($id)->first();
        $getProductId = $getOrderDetail->product_id; //23
        $getQtyOrder = $getOrderDetail->quantity; // 1
        $getBuyerSaldo = $getOrderDetail->order->users->saldo; // saldo saat ini 5568000
        $getTotalPrice = $getOrderDetail->order->total; // akan bertambah 1108000
        $getBuyerID = $getOrderDetail->order->users_id; // 4

        $getSellersId = $getOrderDetail->order->sellers_id;
        $sellerID = ProductSeller::whereUserId($getSellersId)->first(); // id seller dr table product sller
        $getSellerStock = $sellerID->stock;

        $getAdmin = User::whereRoleId(1)->first();
        // dd($getAdmin->saldo);
        $adminId = $getAdmin->id;
        $adminSaldo = $getAdmin->saldo;
        // $buyerId = Order::whereUsersId($reqBuyerId)->first();
        // dd($getSellerSaldo);
        // kesimpulan : saldo users akan menjadi 6676000, saldo admin kembali lagi jadi 70k , stock product seller pada order ini  yg sebelumnya 29 jadi 30
        Order::where('id', $id)
            ->update(
                [
                    // Success
                    'status' => 'Pesanan Ditolak Admin',
                    'updated_at' => $mytime
                ]
            );
        User::where('id', $getBuyerID)
            ->update(
                [
                    'saldo' => $getBuyerSaldo + $getTotalPrice
                ]
            );
        User::where('id', $adminId)
            ->update(
                [
                    // Success
                    'saldo' => $adminSaldo - $getTotalPrice
                ]
            );
        ProductSeller::where('product_id', $getProductId)
            ->update(
                [
                    // Success
                    'stock' => $getSellerStock + $getQtyOrder
                ]
            );
        return redirect('/admin-dashboard')->with('success', 'Pesanan Berhasil Di tolak');
    }

    public function updateListOrder(Request $request, $id)
    {
        Order::where('id', $id)
            ->update(
                [
                    'resi' => $request->resiNumber,
                    'status' => 'Pesanan Dikirim Kepada Pembeli'
                ]
            );
        return redirect('admin-dashboard/')->with('success', 'Pesanan Berhasil Dikirim');
    }
}
