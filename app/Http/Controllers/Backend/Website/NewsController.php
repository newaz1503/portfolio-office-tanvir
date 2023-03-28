<?php

/**
 * izi-starter
* Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\Website\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {
        $query = News::latest();
        $query->whereLike( $request->field_name, $request->value );

        $datas = $query->paginate( $request->pagination );
        return new Resource( $datas );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'layouts.backend_app' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $data = $request->all();
        $file = $request->file( 'image' );
        if ( !empty( $file ) ) {
            $data['image'] = $this->upload( $file, 'news' );
        }

        $res = News::create( $data );
        return $this->responseReturn( "create", $res );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, News $news ) {
        if ( $request->format() == 'html' ) {
            return view( 'layouts.backend_app' );
        }
        return $news;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit( News $news ) {
        return view( 'layouts.backend_app' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, News $news ) {
        $data = $request->all();
        $file = $request->file( 'image' );

        if ( !empty( $file ) ) {
            $data['image'] = $this->upload( $file, 'news', $news->image );
        } else {
            $data['image'] = $this->oldFile( $news->image );
        }

        $news->update( $data );

        return $this->responseReturn( "update", $news );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy( News $news ) {
        $old = $this->oldFile( $news->image );
        if ( Storage::disk( 'public' )->exists( $old ) ) {
            Storage::delete( $old );
        }
        $res = $news->delete();
        return $this->responseReturn( "delete", $res );
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck( $request ) {
        return $request->validate( [
            //ex: 'name' => 'required|email|nullable|date|string|min:0|max:191',
        ] );
    }
}
