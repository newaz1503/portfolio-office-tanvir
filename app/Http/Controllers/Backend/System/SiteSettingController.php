<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\System\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\GlobalHelper;

class SiteSettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = SiteSetting::first();
        return response()->json($data);
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

        $conf  = SiteSetting::first();
        $data  = $request->all();
        $file1 = $request->file('logo');
        $file2 = $request->file('logo_small');
        $file3 = $request->file('favicon');
        $file5 = $request->file('header_image');
        GlobalHelper::envUpdate('PAYPAL_SANDBOX_CLIENT_ID',$request->client_id);
        GlobalHelper::envUpdate('PAYPAL_SANDBOX_CLIENT_SECRET',$request->client_secret);
        if (!empty($conf)) {
            $this->validateCheck($request);
            // LOGO UPLOAD
            if (!empty($file1)) {
                $data['logo'] = $this->upload($file1, 'conf', $conf->logo);
            } else {
                $data['logo'] = $this->oldFile($conf->logo);
            }

            // LOGO SMALL UPLOAD
            if (!empty($file2)) {
                $data['logo_small'] = $this->upload($file2, 'conf', $conf->logo_small);
            } else {
                $data['logo_small'] = $this->oldFile($conf->logo_small);
            }

            // FAVICON UPLOAD
            if (!empty($file3)) {
                $data['favicon'] = $this->upload($file3, 'conf', $conf->favicon);
            } else {
                $data['favicon'] = $this->oldFile($conf->favicon);
            }
            // FAVICON UPLOAD
            if (!empty($file5)) {
                $data['header_image'] = $this->upload($file5, 'conf', $conf->header_image);
            } else {
                $data['header_image'] = $this->oldFile($conf->header_image);
            }

            $conf->update($data);
        } else {
            $this->validateCheck($request);
            if (!empty($file1)) {
                $data['logo'] = $this->upload($file1, 'conf');
            }

            if (!empty($file2)) {
                $data['logo_small'] = $this->upload($file2, 'conf');
            }

            if (!empty($file3)) {
                $data['favicon'] = $this->upload($file3, 'conf');
            }

            if (!empty($file5)) {
                $data['header_image'] = $this->upload($file5, 'conf');
            }

            SiteSetting::create($data);
        }
        $type = !empty($content) ? 'Update' : 'Create';
        return response()->json(['message' => $type . ' Successfully!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SiteSetting  $SiteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SiteSetting $siteSetting)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return SiteSetting::first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SiteSetting  $SiteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SiteSetting  $SiteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $siteSetting)
    {
        return view('layouts.backend_app');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SiteSetting  $SiteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        $old1 = $this->oldFile($siteSetting->logo);
        $old2 = $this->oldFile($siteSetting->logo_small);
        $old3 = $this->oldFile($siteSetting->favicon);
        $old4 = $this->oldFile($siteSetting->header_image);

        if (Storage::disk('public')->exists($old1)) {
            Storage::delete($old1);
        }

        if (Storage::disk('public')->exists($old2)) {
            Storage::delete($old2);
        }

        if (Storage::disk('public')->exists($old3)) {
            Storage::delete($old3);
        }
        if (Storage::disk('public')->exists($old4)) {
            Storage::delete($old4);
        }
        if ($siteSetting->delete()) {
            return response()->json(['message' => 'Delete Successfully!'], 200);
        } else {
            return response()->json(['message' => 'Delete Unsuccessfully!'], 200);
        }
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id = null)
    {
        return $request->validate([
            'title'       => 'required|string|min:0|max:191',
            // 'short_title' => 'required|string|min:0|max:191',
            'logo'        => 'nullable|mimes:jpeg,jpg,png',
            // 'logo_small'  => 'nullable|mimes:jpeg,jpg,png',
            'favicon'     => 'nullable|mimes:jpeg,jpg,png',
        ]);
    }
}
