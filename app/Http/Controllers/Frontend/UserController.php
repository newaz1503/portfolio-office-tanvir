<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Portfolio;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user_register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $password = $request->password;

        $this->Validate($request,[
            'name'=>'required|string',
            'email'=>'required|unique:users',
            'mobile'=>'required',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->password = Hash::make($password);
        $user->save();

        $credential =  [
            'email' => $email,
            'password' => $password
        ];
        if (!empty($credential)) {
            if (Auth::attempt($credential)) {
                return response()->json("Registered",200);
                // return response([
                //     'message'   => "Login Successfully",
                //     'id'        => Auth::user()->id ?? "",
                //     'name'      => Auth::user()->name ?? ""
                // ], 200);
            } else {
                return response([
                    'message'  => "Your Login Information is Wrong!"
                ], 201);
            }
        } else {
            return response([
                'message'  => "Email does not match our records!"
            ], 201);
        }
        Toastr::success('Thank you for registration', 'Success');
    }

    public function user_order(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.order.index', compact('orders'));
    }
    public function user_order_destroy($id){
        $order = Order::find($id);
        $order->delete();
        Toastr::success('Order Deleted Succesfully', 'Success');
        return back();
    }

    public function user_logout(){
        session()->flush();
        Auth::logout();
        return redirect()->route('front');
    }

    public function checkout($id){
        $portfolio = Portfolio::find($id);
        $carts = session()->get('cart');
        $total_price = 0;
        $total_quanity = 0;
        if(!empty($carts)){
            foreach($carts as $cart){
                $total_price +=  $cart['price'];
                $total_quanity +=  $cart['quantity'];
            }
        }

        if(!empty($carts)){
            return view('frontend.checkout',compact('carts','total_price','total_quanity'));
        }
        if(Auth::check()){

            $cart['$id'] = [
                'id' => $portfolio->id,
                "title" => $portfolio->title,
                "price" => $portfolio->price,
                "image" => $portfolio->image,
                "quantity" => 1,
            ];

            session()->put('cart', $cart);
            return redirect()->to('payment-process');
        }else{
            Toastr::info('Info', 'You need to login first');
            return redirect()->route('login');
        }



        // $portfolio = Portfolio::find($id);
        // $portfolios = Portfolio::where('status', 'active')->latest()->get();
        // if(Auth::check()){
        //     $order = new Order();
        //     $order->user_id = Auth::user()->id;
        //     $order->portfolio_id = $portfolio->id;
        //     $order->save();
        //     return view('frontend.checkout', compact('portfolio', 'portfolios'));
        // }else{
        //     Toastr::info('Info', 'You need to login first');
        //     return redirect()->route('login');
        // }
    }

    public function buy_now($id){
        $carts = session()->get('cart');
        $total_price = 0;
        $total_quanity = 0;

        foreach($carts as $cart){
            $total_price +=  $cart['price'];
            $total_quanity +=  $cart['quantity'];
        }
        if(!empty($carts)){
            return view('frontend.checkout',compact('carts','total_price','total_quanity'));
        }


    }


}
