<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\PhotographyPrice;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;

class PhotographyPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = PhotographyPrice::latest();
        $query->whereLike( $request->field_name, $request->value );

        $datas  = $query->paginate($request->pagination);
        return new Resource($datas);
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
                $res = PhotographyPrice::create($request->all());
                return $this->responseReturn( "create", $res );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhotographyPrice  $photographyPrice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PhotographyPrice $photographyPrice)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $photographyPrice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhotographyPrice  $photographyPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(PhotographyPrice $photographyPrice)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhotographyPrice  $photographyPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhotographyPrice $photographyPrice)
    {
        if ($this->validateCheck($request, $photographyPrice->id)) {
            try {
                $data = $request->all();
                $photographyPrice->fill( $data )->save();

                return $this->responseReturn( "update", $photographyPrice );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhotographyPrice  $photographyPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotographyPrice $photographyPrice)
    {
        $res = $photographyPrice->delete();
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
