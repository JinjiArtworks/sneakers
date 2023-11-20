<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Models\Models;
use Illuminate\Http\Request;

class AddModelsController extends Controller
{
    public function index()
    {
        $models = Models::get();
        return view('admin.listResources.models.index', compact('models'));
    }
    // Add vendor
    public function create()
    {
        $models = Models::all();
        return view('admin.listResources.models.create', compact('models'));
    }
    public function store(Request $request)
    {
        if ($request->catImages != null) {
            $destinationPath = '/img/list';
            $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
            Models::create([
                'thumbnail' => $request->catImages->getClientOriginalName(),
                'name' => $request->catName,
            ]);
        }
        return redirect('/list-models')->with('success', 'models berhasil ditambahkan');
    }
    public function edit($id)
    {
        $models = Models::find($id);
        return view('admin.listResources.models.edit', compact('models'));
    }
    public function update(Request $request, $id)
    {
        if ($request->catImages != null) {
            $destinationPath = '/img/list';
            $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
            Models::where('id', $id)
                ->update(
                    [
                        'thumbnail' => $request->catImages->getClientOriginalName(),
                        'name' => $request->catName,
                    ]
                );
        } else {
            return redirect()->back()->with('success', 'models berhasil ditambahkan');
        }
        return redirect('/list-models')->with('success', 'models berhasil diubah.');
    }
    public function destroy($id)
    {
        Models::where('id', $id)->delete();
        return redirect()->back()->with('success', 'models berhasil dihapus.');
    }
}
