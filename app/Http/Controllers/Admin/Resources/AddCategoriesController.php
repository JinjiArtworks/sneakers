<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class AddCategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::get();
        return view('admin.listResources.category.index', compact('categories'));
    }
    // Add vendor
    public function create()
    {
        $category = Categories::all();
        return view('admin.listResources.category.create', compact('category'));
    }
    public function store(Request $request)
    {
        if ($request->catImages != null) {
            $destinationPath = '/img/list';
            $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
            Categories::create([
                'thumbnail' => $request->catImages->getClientOriginalName(),
                'name' => $request->catName,
            ]);
        }
        return redirect('/list-category')->with('success', 'Category berhasil ditambahkan');
    }
    public function edit($id)
    {
        $category = Categories::find($id);
        return view('admin.listResources.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        if ($request->catImages != null) {
            $destinationPath = '/img/list';
            $request->catImages->move(public_path($destinationPath), $request->catImages->getClientOriginalName());
            Categories::where('id', $id)
                ->update(
                    [
                        'thumbnail' => $request->catImages->getClientOriginalName(),
                        'name' => $request->catName,
                    ]
                );
        } else {
            return redirect()->back()->with('success', 'Category berhasil ditambahkan');
        }
        return redirect('/list-category')->with('success', 'Category berhasil diubah.');
    }
    public function destroy($id)
    {
        Categories::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category berhasil dihapus.');
    }
}
