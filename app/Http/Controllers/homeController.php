<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $items = Item::paginate(PAGINATION_COUNT);
        return view('index',['items' => $items]);
    }

    public function search(Request $request)
    {
        $keyword=$request->validate([
            'keyword'=>'required|string|min:3'
        ]);
        $keyword = $request->keyword;

        
        $items = Item::paginate(PAGINATION_COUNT);
        $search = Item::where('title','like',"%$keyword%")->get();
        if($search && $search->isEmpty())
        {
            return view('search.notfound',['keyword' => $keyword]);
        }
        
        
        return view('index',['search' => $search ,'keyword' => $keyword,'items' => $items]);
    }

    public function dashboard()
    {
       $users = User::where('role_id','!=',1)->count();
       $orders = Order::count();
       $cats = Category::count();
       $products = Item::count();
       $reports = Report::count();
       $admin = User::where('role_id',1)->count();
       $userMakingOrders = Order::distinct()->count('user_id');
       $lastOrders = Order::where('created_at', '>', Carbon::now()->subDay())->count();
       return view('admin.dashboard',compact('users','orders', 'admin','userMakingOrders' ,'lastOrders', 'products','reports','cats' ));
    }
    
}
