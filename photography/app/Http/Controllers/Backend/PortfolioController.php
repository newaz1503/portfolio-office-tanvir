<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;

class PortfolioController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = Portfolio::with('category','portfolioTypes')->latest();
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
            $data = $request->all();
            if (!empty($request->image)) {
                $data['image'] = $this->upload($request->image, 'portfolio', null);
            }
            $res = Portfolio::create($data);
            return $this->responseReturn("create", $res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Portfolio $portfolio)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $portfolio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        if ($this->validateCheck($request, $portfolio->id)) {
            $data = $request->all();
            $file = $request->file('image');

            if (!empty($file)) {
                $data['image'] = $this->upload($file, 'portfolio', $portfolio->image);
            } else {
                $data['image'] = $this->oldFile($portfolio->image);
            }
            $portfolio->update($data);

            return $this->responseReturn("update", $portfolio);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $res = $portfolio->delete();
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
