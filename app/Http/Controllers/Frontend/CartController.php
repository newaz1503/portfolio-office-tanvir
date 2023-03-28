<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function add_cart(Request $request){

    //         $portfolio_id = $request->input('portfolio_id');
    //         $cart = new Cart();
    //         // $cart->user_id = Auth::id();
    //         $cart->portfolio_id = $portfolio_id;
    //         $cart->save();
    //         return response()->json([
    //             'message' => 'Cart Added Successfully'
    //         ]);
    //     }

    // public function delete_cart(Request $request){
    //     $cart_id = $request->input('cart_id');
    //     $cart = Cart::find($cart_id);
    //     if($cart){
    //         $cart->delete();
    //     }
    //     return response()->json([
    //         'message' => 'Image Deleted Successfully'
    //     ]);
    // }

    public function addToCart($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if($portfolio){
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
            Toastr::success('success', 'Image added to cart successfully!');
            return redirect()->back();
        }else{
            Toastr::error('Error', 'Image not found');
            return redirect()->back();
        }

    }
    public function viewPaymentPage()
    {
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
        return redirect()->route('front');

    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            Toastr::success('success', 'Image removed successfully');
            return response()->json('Success',200);
        }
    }

}
