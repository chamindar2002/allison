<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

use Allison\Repositories\Contracts\IfFbAdPublishRepository;
use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\Repositories\Contracts\IfFbAdSetRepository;

use Allison\Http\Requests\FbAdPublishRequest;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdPublishHelper;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;

use Session;

class AdPublishController extends Controller
{
    
    public function __construct(IfFbAdPublishRepository $fb_adpublish, IfFbAdCreativeRepository $fb_adcreative, IfFbAdSetRepository $fb_adset)
    {
        
        $this->fb_adpublish = $fb_adpublish;
        $this->fb_adcreative = $fb_adcreative;
        $this->fb_adset = $fb_adset;
        
    }
    
    public function index()
    {
        $ads = $this->fb_adpublish->getAllAds();
        
        return view('admanager.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Config('facebook.STATUSES');
        
        unset($statuses['STATUS_ARCHIVED']);
        
        $adcreatives = $this->fb_adcreative->listAdCreatives();
        
        $adsets = $this->fb_adset->listAdSets();
        
        return view('admanager.ads.create', compact('statuses', 'adcreatives', 'adsets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdPublishRequest $request, Fb_AdPublishHelper $ad_adpublish_helper)
    {
        $ad = $this->fb_adpublish->create($request, $ad_adpublish_helper, $this->fb_adset, $this->fb_adcreative);
        
//        if ($this->fb_adpublish->create($request, $ad_adpublish_helper, $this->fb_adset, $this->fb_adcreative)) {
//             Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
//        }
        
        $ad->getExceptionMessage();
        
        if(!is_object($ad)){
            Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad->getExceptionMessage());
            return redirect('/Exception/'.$ad->getExceptionCode());
        }
        
        return redirect('ad/ad-publish');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = $this->fb_adpublish->getAd($id);

        return view('admanager.ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $statuses = Config('facebook.STATUSES');
        
        $adcreatives = $this->fb_adcreative->listAdCreatives();
        
        $adsets = $this->fb_adset->listAdSets();
                
        $ad = $this->fb_adpublish->getAd($id);
                
        return view('admanager.ads.update', compact('ad','statuses', 'adcreatives', 'adsets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdPublishRequest $request, Fb_AdPublishHelper $ad_adpublish_helper, $id)
    {
        
        $ad = $this->fb_adpublish->update($request, $ad_adpublish_helper, $id);
        
//        if($this->fb_adpublish->update($request, $ad_adpublish_helper, $id)){
//             Session::flash('alert-success',Fb_AdUtilities::dumpUpdateteSuccessMessage());
//        }
        
        if(!is_object($ad)){
            Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad->getExceptionMessage());
            return redirect('/Exception/'.$ad->getExceptionCode());
        }
        
        return redirect('ad/ad-publish');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fb_AdPublishHelper $ad_adpublish_helper, $id)
    {
        $ad = $this->fb_adpublish->destroy($ad_adpublish_helper, $id);
        
//        if ($this->fb_adpublish->destroy($ad_adpublish_helper, $id)) {
//            return redirect('ad/ad-publish');
//        }
        
        if(!is_object($ad)){
           Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad->getExceptionMessage());
            return redirect('/Exception/'.$ad->getExceptionCode());
        }
    }
}
