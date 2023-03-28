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

        $portfolios = Portfolio::where('status', 'active')->latest()->get();
        $portfolio = Portfolio::findOrFail($id);
        if(Auth::check()){
            $cart = session()->get('cart', []);
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }else{
                $cart[$id] = [
                    'id' => $portfolio->id,
                    "title" => $portfolio->title,
                    "price" => $portfolio->price,
                    "image" => $portfolio->image,
                    "quantity" => 1,
                ];
            }

            session()->put('cart', $cart);
            return view('frontend.checkout', compact('portfolio', 'portfolios'));
        }else{
            Toastr::error('Error', 'Image not found');
            return redirect()->back();
        }
    }

}
