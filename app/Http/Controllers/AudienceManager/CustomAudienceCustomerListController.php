<?php

namespace Allison\Http\Controllers\AudienceManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAudienceCustom;
use Allison\Repositories\Contracts\IfFbAudiencePixel;
use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceUtilities;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Http\Requests\FbAudienceCustomRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceCustomHelper;
use Session;

class CustomAudienceCustomerListController extends Controller
{
    
    public function __construct(IfFbAudienceCustom $fb_audience_custom, IfFbAudiencePixel $fb_audience_pixel)
    {
        $this->fb_audience_custom = $fb_audience_custom;
        $this->fb_audience_pixel = $fb_audience_pixel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pixel = $this->fb_audience_pixel->listAudiencePixel();
        $subtypes = Fb_AudienceUtilities::custom_audience_sub_types();
        $data_types = Fb_AudienceUtilities::custom_audience_data_types();
        
        return view('audience.custom-c-list.create', compact('pixel', 'data_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAudienceCustomRequest $request, Fb_AudienceCustomHelper $audience_custom_helper)
    {
        if ($this->fb_audience_custom->create_customer_list($request, $audience_custom_helper)) {
             Session::flash('alert-success', Fb_AdUtilities::dumpCreateSuccessMessage());
        }
        
        return redirect('ad/audience-custom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pixel = $this->fb_audience_pixel->listAudiencePixel();
        $subtypes = Fb_AudienceUtilities::custom_audience_sub_types();
        $data_types = Fb_AudienceUtilities::custom_audience_data_types();
        $custom_audience = $this->fb_audience_custom->getCustomAudience($id);
        $custom_audience->data = '';#do not display data
        
        return view('audience.custom-c-list.update', compact('custom_audience', 'pixel', 'data_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAudienceCustomRequest $request, Fb_AudienceCustomHelper $audience_custom_helper, $id)
    {
        if($this->fb_audience_custom->update_customer_list($request, $audience_custom_helper, $id)){
             Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
        }
        return redirect('ad/audience-custom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
