<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\Categories;
use App\Models\Coupon;
use App\Models\Models;
use App\Models\Motif;
use App\Models\OwnerVendor;
use App\Models\Product;
use App\Models\Teknik;
use App\Models\VendorOrder;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = VendorOrder::get();

        $vendorsId = VendorOrder::first('id');
        $getVendorsName = OwnerVendor::whereId($vendorsId->id)->first();
        // return dd($vendor->gambar);
        return view('admin.listVendor.index', compact('vendor', 'getVendorsName'));
    }

    // Add vendor
    public function create()
    {
        $vendor = VendorOrder::all();
        $vendorOwner = OwnerVendor::all();
        // return dd($categories);
        return view('admin.listVendor.create', compact('vendor', 'vendorOwner'));
    }
    public function store(Request $request)
    {
        if ($request->productImage != null) {
            $destinationPath = '/images';
            $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
            VendorOrder::create([
                'vendor_id' => $request->vendorOwnerName,
                'tanggal' => $request->ordersDate,
                'nama_produk' => $request->productName,
                'gambar' => $request->productImage->getClientOriginalName(),
                'catatan' => $request->ordersNote,
                'harga' => $request->productPrice,
                'quantity' => $request->productQty,
                'total_pengeluaran' => $request->productPrice * $request->productQty,
            ]);
        }
        return redirect('/admin-vendors')->with('success', 'Data vendors berhasil ditambahkan');
    }
    public function edit($id)
    {
        $vendor = VendorOrder::find($id);

        $vendorsId = VendorOrder::first('id');
        $getVendorsName = OwnerVendor::whereId($vendorsId->id)->first();
        $vendorOwner = OwnerVendor::all();
        return view('admin.listVendor.edit', compact('vendor', 'vendorOwner','getVendorsName'));
    }
    public function update(Request $request, $id)
    {
        $destinationPath = '/images';
        $request->productImage->move(public_path($destinationPath), $request->productImage->getClientOriginalName());
        VendorOrder::where('id', $id)
            ->update(
                [
                    'vendor_id' => $request->vendorOwnerName,
                    'tanggal' => $request->ordersDate,
                    'nama_produk' => $request->productName,
                    'gambar' => $request->productImage->getClientOriginalName(),
                    'catatan' => $request->ordersNote,
                    'harga' => $request->productPrice,
                    'quantity' => $request->productQty,
                    'total_pengeluaran' => $request->productPrice * $request->productQty,
                ]
            );
        return redirect('/admin-vendors')->with('success', 'Product berhasil diubah.');
    }
    public function destroy($id)
    {
        VendorOrder::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product berhasil dihapus.');
    }
}
