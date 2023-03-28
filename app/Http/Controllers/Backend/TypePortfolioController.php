<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\TypePortfolio;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;

class TypePortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = TypePortfolio::latest();
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
                $res = TypePortfolio::create($request->all());
                return $this->responseReturn( "create", $res );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypePortfolio  $typePortfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypePortfolio $typePortfolio)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $typePortfolio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypePortfolio  $typePortfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(TypePortfolio $typePortfolio)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypePortfolio  $typePortfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePortfolio $typePortfolio)
    {
        if ($this->validateCheck($request, $typePortfolio->id)) {
            try {
                $data = $request->all();
                $typePortfolio->fill( $data )->save();

                return $this->responseReturn( "update", $typePortfolio );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypePortfolio  $typePortfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePortfolio $typePortfolio)
    {
        $res = $typePortfolio->delete();
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
