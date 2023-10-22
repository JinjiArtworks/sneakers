<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Models\Alergi;
use App\Models\Categories;
use Illuminate\Http\Request;

class AlergiController extends Controller
{
    public function index()
    {
        $alergi  = Alergi::get();
        return view('admin.listResources.alergi.index', compact('alergi'));
    }
    // Add vendor
    public function create()
    {
        $alergi  = Alergi::all();
        // return dd($categories);
        return view('admin.listResources.alergi.create', compact('alergi'));
    }
    public function store(Request $request)
    {
        Alergi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'efek' => $request->efek,
        ]);
        return redirect('/add-alergi')->with('success', 'Kupon berhasil ditambahkan');
    }
    public function edit($id)
    {
        $alergi  = Alergi::find($id);
        return view('admin.listResources.alergi.edit', compact('alergi'));
    }
    public function update(Request $request, $id)
    {
        Alergi::where('id', $id)
            ->update(
                [
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'efek' => $request->efek,
                ]
            );
        return redirect('/add-alergi')->with('success', 'Kupon berhasil diubah.');
    }
    public function destroy($id)
    {
        Alergi::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kupon berhasil dihapus.');
    }
}
