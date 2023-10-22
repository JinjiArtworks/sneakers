<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::get();
        return view('admin.listResources.kupons.index', compact('coupon'));
    }
    // Add vendor
    public function create()
    {
        $coupon = Coupon::all();
        // return dd($categories);
        return view('admin.listResources.kupons.create', compact('coupon'));
    }
    public function store(Request $request)
    {
        Coupon::create([
            'kode_kupon' => $request->kodeKupon,
            'potongan' => $request->potonganKupon,
            'tanggal_berlaku' => $request->kuponBerlaku,
            'tanggal_berakhir' => $request->kuponBerakhir,
        ]);
        return redirect('/add-kupons')->with('success', 'Kupon berhasil ditambahkan');
    }
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.listResources.kupons.edit', compact('coupon'));
    }
    public function update(Request $request, $id)
    {
        Coupon::where('id', $id)
            ->update(
                [
                    'kode_kupon' => $request->kodeKupon,
                    'potongan' => $request->potonganKupon,
                    'tanggal_berlaku' => $request->kuponBerlaku,
                    'tanggal_berakhir' => $request->kuponBerakhir,
                ]
            );
        return redirect('/add-kupons')->with('success', 'Kupon berhasil diubah.');
    }
    public function destroy($id)
    {
        Coupon::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kupon berhasil dihapus.');
    }
}
