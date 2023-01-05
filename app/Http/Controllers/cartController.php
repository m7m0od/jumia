<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
//use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Mail;

class cartController extends Controller
{
    public function cart(Request $request)
    {
        $item = Item::findOrFail($request->input('item_id'));

        Cart::add(
            $item->id,
            $item->title,
            $request->input('Q'),
            $item->price
        );
        return redirect()->back();
    }

    public function myCart()
    {
        $cart = Cart::content();
        //dd($cart);
        return view('cart.cart',['cart' => $cart]);
    }
    
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function checkout($amount)
    {
        return view('cart.checkout',['amount' => $amount]);
    }

    public function charge(Request $request) 
    {
        //dd($request->stripeToken);
        
        $user = auth()->user()->name;
        $charge = Stripe::charges()->create([
            'amount' => 100*100,
            'currency' => "USD",
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => "payment from `$user`"
        ]);
        $chargeId = $charge['id'];

        if($chargeId)
        {
            $data = ['user_id' => auth()->user()->id];

            $cart = Cart::content();
            //dd($cart);
            $products_id =[];
            $products_name =[];
            foreach($cart as $c){$products_id[] = $c->id;$products_name[]=$c->name;}
            $prod_id = implode(',',$products_id);
            $prod_name = implode(',',$products_name);
            $data['product_id'] = $prod_id;
            $data['product_name'] = $prod_name;

            $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $data['code'] = $code;

            Mail::send('cart.code', ['code' => $code], function($message) use($request){
                $message->to(auth()->user()->email);
                $message->subject('code order');
          });
  
            // save order in orders table
            Order::create($data);

            //clean cart
            Cart::destroy();
            
            return redirect(url('/index'))->with('success','payment was done , We will send you email and be in contact with you , Thanks!');
        }else{
            return redirect()->back();
        }
    }

    public function order()
    {
        $orders = Order::paginate(PAGINATION_COUNT);
        return view('admin.order',['orders' => $orders]);
    }


}
