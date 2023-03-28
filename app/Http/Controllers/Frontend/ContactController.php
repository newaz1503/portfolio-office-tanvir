<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactToAdminMail;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(){
        return view('frontend.contact');
    }
    public function contact_store(Request $request){

        $this->validate($request,[
            'name'=>'required|string',
            'contact_method'=>'required',
            'contact_info'=>'required|string',
            'photoshoot_type'=>'required',
            'location'=>'required|string',
            'details'=>'required|string',
        ]);
        $inquiry = new Inquiry();
        $inquiry->name = $request->name;
        $inquiry->contact_method = $request->contact_method;
        $inquiry->contact_info = $request->contact_info;
        $inquiry->photoshoot_type = $request->photoshoot_type;
        $inquiry->location = $request->location;
        $inquiry->details = $request->details;
        $inquiry->save();
        $email = "saikotkhan44@gmail.com";
        Mail::to($email)->send(new ContactToAdminMail($inquiry));
        return back()->with('message', 'Mail Sent Successfully. Thank you, We will contact you shortly');

    }


}
