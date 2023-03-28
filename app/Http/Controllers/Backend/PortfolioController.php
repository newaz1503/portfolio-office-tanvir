<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use Image;
use Exception;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Support\Facades\File;

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
            $data =  $request->all();
            $image = $request->file('image');

            $data['image'] =  $this->fileUploader($image,'uploads/portfolio/main','uploads/portfolio','uploads/portfolio/watermark');
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
                if(!empty($portfolio->image)){
                   $image = public_path('uploads/portfolio/main/'.$portfolio->image);
                    if(File::exists( $image)){
                        unlink($image);
                    }
                    $image = public_path('uploads/portfolio/'.$portfolio->image);
                    if(File::exists( $image)){
                        unlink($image);
                    }
                    $image = public_path('uploads/portfolio/watermark/'.$portfolio->image);
                    if(File::exists( $image)){
                        unlink($image);
                    }
                }
                $data['image'] =  $this->fileUploader($file,'uploads/portfolio/main','uploads/portfolio','uploads/portfolio/watermark');
            } else {
                $data['image'] = $portfolio->image;
            }
            $portfolio->update($data);

            return $this->responseReturn("update", $portfolio);
        }
    }


    protected function fileUploader($image, $mainFolder, $portfolioFolder,$watermarkFolder)
    {
        $input['image'] = time().'.'.$image->getClientOriginalExtension();

        $imgFile = Image::make($image->getRealPath());
        $imgFile->save(public_path($mainFolder.'/'.$input['image']));
        $imgFile->save(public_path($portfolioFolder.'/'.$input['image']));
        $imgFile->text('Tanvir Ahamed',120 , 130, function($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(30);
            $font->color("ffffff");
            $font->align('center');
            $font->valign('center');
            $font->angle(45);

        })->save(public_path($watermarkFolder.'/'.$input['image']));

        return  $input['image'];
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
        if(!empty($portfolio->image)){
            $image = public_path('uploads/portfolio/main/'.$portfolio->image);
             if(File::exists( $image)){
                 unlink($image);
             }
             $image = public_path('uploads/portfolio/'.$portfolio->image);
             if(File::exists( $image)){
                 unlink($image);
             }
             $image = public_path('uploads/portfolio/watermark/'.$portfolio->image);
             if(File::exists( $image)){
                 unlink($image);
             }
         }

        return $this->responseReturn( "delete", $res );
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id=null)
    {
        return $request->validate([
            'category_id' => 'required',
            'typeportfolio_id' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);
    }
}
