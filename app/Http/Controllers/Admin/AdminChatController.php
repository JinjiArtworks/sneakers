<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Returns;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    public function index()
    {
        $chats = Chat::get();
        return view('admin.chats.index',compact('chats'));
    }
    public function sendAdminMsg(Request $request)
    {
        $user = Auth::user()->id;
        Chat::create([
            'user_id' => $user,
            'chat_admin' => $request->adminMsg,
        ]);
        return redirect()->back();
    }
}
