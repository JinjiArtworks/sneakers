<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class AddCategoriesController extends Controller
{
    public function index()
    {
        $kategori = Categories::get();
        return view('admin.listResources.kategori.index', compact('kategori'));
    }
    // Add vendor
    public function create()
    {
        $kategori = Categories::all();
        // return dd($categories);
        return view('admin.listResources.kategori.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        if ($request->catImages != null) {
            $destinationPath = '/images';
            $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
            Categories::create([
                'gambar' => $request->catImages->getClientOriginalName(),
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
        }
        return redirect('/add-kategori')->with('success', 'Kupon berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kategori = Categories::find($id);
        return view('admin.listResources.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, $id)
    {
        $destinationPath = '/images';
        $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
        Categories::where('id', $id)
            ->update(
                [
                    'gambar' => $request->catImages->getClientOriginalName(),
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,

                ]
            );
        return redirect('/add-kategori')->with('success', 'Kupon berhasil diubah.');
    }
    public function destroy($id)
    {
        Categories::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kupon berhasil dihapus.');
    }
}
