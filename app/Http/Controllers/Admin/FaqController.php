<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $faq = Faq::all();
        // return dd($products);
        return view('admin.faq.index', compact('faq','user_id'));
    }
    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }
    public function store(Request $request)
    {
        Faq::create([
            'pesan' => $request->pertanyaan,
        ]);
        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan');
    }
    public function update(Request $request,$id)
    {
        Faq::where('id', $id)
            ->update(
                [
                    'jawaban' => $request->jawaban,
                ]
            );
        return redirect()->back()->with('success', 'Alamat berhasil diubah');
    }
    public function destroy($id)
    {
        Faq::where('id', $id)->delete();
        return redirect()->back()->with('success', 'FAQ berhasil dihapus.');
    }
}
