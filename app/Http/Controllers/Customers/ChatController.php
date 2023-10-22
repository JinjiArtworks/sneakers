<?php

namespace App\Http\Controllers\Customers;

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

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::get();
        return view('customers.chat.index', compact('chats'));
    }

    public function sendUserMsg(Request $request)
    {
        $user = Auth::user()->id;
        Chat::create([
            'user_id' => $user,
            'chat_user' => $request->userMsg,
        ]);
        // return dd($id);

        return redirect()->back();
    }
}
