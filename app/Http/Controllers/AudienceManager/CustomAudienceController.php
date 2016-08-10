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
use Event;
use Allison\Events\FbAudienceSync\AudienceCustomReadEvent;


class CustomAudienceController extends Controller
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
    public function index(Fb_AudienceCustomHelper $audience_custom_helper)
    {
        $custom_audience = $this->fb_audience_custom->getAllCustomAudiences();
        Event::fire(new AudienceCustomReadEvent($this->fb_audience_custom, $audience_custom_helper));
        return view('audience.custom.index', compact('custom_audience'));
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
        $prefill = Fb_AudienceUtilities::custom_audience_pre_fill();
        $website_traffic = Fb_AudienceUtilities::website_traffic();
        $rule_definer = Fb_AudienceUtilities::rule_definer();
        
        return view('audience.custom.create', compact('pixel', 'subtypes', 'prefill', 'website_traffic', 'rule_definer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAudienceCustomRequest $request, Fb_AudienceCustomHelper $audience_custom_helper)
    {
        $request->flashOnly('website_traffic');
        if ($this->fb_audience_custom->create($request, $audience_custom_helper)) {
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
       $custom_audience = $this->fb_audience_custom->getCustomAudience($id);

        return view('audience.custom.show', compact('custom_audience'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $custom_audience = $this->fb_audience_custom->getCustomAudience($id);
        $pixel = $this->fb_audience_pixel->listAudiencePixel();
        $subtypes = Fb_AudienceUtilities::custom_audience_sub_types();
        $prefill = Fb_AudienceUtilities::custom_audience_pre_fill();
        $website_traffic = Fb_AudienceUtilities::website_traffic();
        $rule_definer = Fb_AudienceUtilities::rule_definer();
        
        return view('audience.custom.update', compact('pixel', 'subtypes', 'prefill', 'website_traffic', 'rule_definer', 'custom_audience'));
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
        if($this->fb_audience_custom->update($request, $audience_custom_helper, $id)){
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
    public function destroy(Fb_AudienceCustomHelper $audience_custom_helper, $id)
    {
        if ($this->fb_audience_custom->destroy($audience_custom_helper, $id)) {
            return redirect('ad/audience-custom');
        }
    }
    
    public function selectCreate(){
        return view('audience.custom.select');
    }
}
