<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Exception;
use App\Http\Controllers\Base\BaseController;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AboutController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query  = About::first();
        // $query->whereLike( $request->field_name, $request->value );

        // $datas  = $query->paginate($request->pagination);
        return response()->json($query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend_app');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validateCheck($request)) {
            try {
                // dd($request->all());
                $data = $request->all();
                $file =  $request->file('image');
                if (!empty($file)) {
                    $data['image'] = $this->upload($file, 'about', null);
                }
                $about = About::first();
                if(!empty($about)){
                    $res =   $about->update($data);
                }else{
                    $res =   About::create($data);
                }
                return $this->responseReturn( "create", $res );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, About $about)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $about;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $data = $request->all();
        $file = $request->file('image');

        if (!empty($file)) {
            $data['image'] = $this->upload($file, 'about', $about->image);
        } else {
            $data['image'] = $about->image;
        }

        $about = About::first();
        if(!empty($about)){
            $about->update($data);
        }else{
           About::create($data);
        }

        return $this->responseReturn("update", $about);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $res = $about->delete();
        return $this->responseReturn( "delete", $res );
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id=null)
    {
        return true;
        return $request->validate([
            //ex: 'name' => 'required|email|nullable|date|string|min:0|max:191',
        ],[
            //ex: 'name' => "This name is required" (custom message)
        ]);
    }
}
