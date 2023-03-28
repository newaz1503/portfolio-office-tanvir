<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use ZipArchive;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        //download image
        if(session()->has('cart')){
            $zip_file = 'images.zip';
            $zip = new \ZipArchive();
            if ($zip->open(public_path($zip_file), ZipArchive::CREATE) === TRUE) {
                foreach(session('cart') as $item) {
                    if(!empty($item['image'])){
                        $path =  public_path("uploads/portfolio/main/{$item['image']}");
                        $relativeName = basename($path);
                        $zip->addFile($path, $relativeName);
                        // $zip->addFile(public_path("uploads/portfolio/main/{$item['image']}"), $item['image']);
                    }
                }
                $zip->close();
                return response()->download(public_path($zip_file));
            }
        }
        echo 'Thank You';
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {

        $order = new Order();
        $order->user_id = Auth::id();
        $order->portfolio_id = $request->portfolio_id;
        $order->total = $request->price;
        $order->save();
        if(!empty(session('cart'))){
            foreach (session('cart') as $cart_item) {
                $order_deails = new OrderDetails();
                $order_deails->order_id = $order->id;
                $order_deails->portfolio_id = $cart_item['id'];
                $order_deails->portfolio_quantity = $cart_item['quantity'];
                $order_deails->total_price = $cart_item['price'];
                $order_deails->save();
            }
        }

        if(session('cart')){
            session()->forget('cart');
        }

        //download image
        // if(session()->has('cart')){
        //     $zip_file = 'images.zip';
        //     $zip = new \ZipArchive();
        //     if ($zip->open(public_path($zip_file), ZipArchive::CREATE) === TRUE) {
        //         foreach(session('cart') as $item) {
        //             if(!empty($item['image'])){
        //                 $path =  public_path("uploads/portfolio/main/{$item['image']}");
        //                 $relativeName = basename($path);
        //                 $zip->addFile($path, $relativeName);
        //                 // $zip->addFile(public_path("uploads/portfolio/main/{$item['image']}"), $item['image']);
        //             }
        //         }
        //         $zip->close();
        //         return response()->download(public_path($zip_file));
        //     }
        // }


        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    protected function getDownload()
{
    //PDF file is stored under project/public/download/info.pdf
    $file= public_path(). "/uploads/portfolio/main";

    $headers = array(
              'Content-Type: application/zip',
            );

    return Response::download($file, 'filename.pdf', $headers);
}

}


