<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\ServiceDetails;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;

class ServiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = ServiceDetails::latest();
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
                $res = ServiceDetails::create($request->all());
                return $this->responseReturn( "create", $res );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceDetails  $serviceDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $serviceDetails = ServiceDetails::findOrFail($id);
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $serviceDetails;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceDetails  $serviceDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceDetails $serviceDetails)
    {

        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceDetails  $serviceDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serviceDetails = ServiceDetails::findOrFail($id);
        if ($this->validateCheck($request, $serviceDetails->id)) {
            try {
                $data = $request->all();
                $serviceDetails->fill( $data )->save();

                return $this->responseReturn( "update", $serviceDetails );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceDetails  $serviceDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceDetails = ServiceDetails::findOrFail($id);
        $res = $serviceDetails->delete();
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
