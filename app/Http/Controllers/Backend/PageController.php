<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Page::latest();
        $query->whereLike($request->field_name, $request->value);

        $datas = $query->paginate($request->pagination);
        return new Resource($datas);
    }

    public function getPagesForMenu()
    {
        $pages = Page::select('id', 'title')
            ->where('status', 'active')
            ->get();
        return response()->json($pages);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validateCheck($request)) {
            try {
                $data = $request->all();
                $file = $request->file('image');
                if (!empty($file)) {
                    $data['image'] = $this->upload($file, 'pageImage');
                }
                $res = Page::create($data);
                return $this->responseReturn("create", $res);
            } catch (Exception $ex) {
                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $page;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if ($this->validateCheck($request, $page->id)) {
            try {
                $data = $request->all();
                $file = $request->file('image');
                if (!empty($file)) {
                    $data['image'] = $this->upload($file, 'pageImage', $page->image);
                } else {
                    $data['image'] = $this->oldFile($page->image);
                }

                $page->fill($data)->save();
                return $this->responseReturn("update", $page);
            } catch (Exception $ex) {
                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $old = $this->oldFile($page->image);
        if (Storage::disk('public')->exists($old)) {
            Storage::delete($old);
        }
        $res = $page->delete();
        return $this->responseReturn("delete", $res);
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id = null)
    {
        return $request->validate([
            'title' => 'required',
        ]);
    }
}
