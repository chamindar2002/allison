<?php

namespace Allison\Http\Controllers\AdManager;

use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\Repositories\Contracts\IfFbAdMediaRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Http\Requests\FbAdCreativeRequest;


use Allison\AllisonFbApiHelpers\helpers\Fb_AdCreativeHelper;

use Session;

class AdCreativeController extends Controller
{
    
    public function __construct(IfFbAdCreativeRepository $fb_adcreative, IfFbAdMediaRepository $fb_admedia)
    {
        $this->fb_adcreative = $fb_adcreative;
        $this->fb_admedia = $fb_admedia;
    }
        
    public function index()
    {
        $ad_creatives = $this->fb_adcreative->getAllAdCreatives();

        return view('admanager.adcreative.index', compact('ad_creatives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = $this->fb_admedia->getAllAdMedia();
        
        $path = Fb_AdUtilities::thumbview_media_path();
        
        $media_config = Config('facebook.MEDIA_IMAGES');
        
        $checked_media = array();
        
        return view('admanager.adcreative.create', compact('media', 'path', 'media_config', 'checked_media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdCreativeRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper)
    {
             
        $ad_creative = $this->fb_adcreative->create($request, $ad_adcreative_helper);
        
//        if ($this->fb_adcreative->create($request, $ad_adcreative_helper)) {
//            
//             Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
//            
//        }
        if(!is_object($ad_creative)){
           Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_creative->getExceptionMessage());
            return redirect('/Exception/'.$ad_creative->getExceptionCode());
        }
        
        return redirect('ad/ad-creative');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adcreative = $this->fb_adcreative->getAdCreative($id);

        return view('admanager.adcreative.show', compact('adcreative'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adcreative = $this->fb_adcreative->getAdCreative($id);
        
        $media = $this->fb_admedia->getAllAdMedia();
        
        $path = Fb_AdUtilities::thumbview_media_path();
        
        $media_config = Config('facebook.MEDIA_IMAGES');
        
        $checked_media = $this->fb_adcreative->listMedia($adcreative);
                
        return view('admanager.adcreative.update', compact('adcreative','media', 'path', 'media_config', 'checked_media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdCreativeRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper, $id)
    {
        
        $ad_creative = $this->fb_adcreative->update($request, $ad_adcreative_helper, $id);
        
//        if ($this->fb_adcreative->update($request, $ad_adcreative_helper, $id)) {
//            
//            Session::flash('alert-success',Fb_AdUtilities::dumpUpdateteSuccessMessage());
//            
//        }
        
        if(!is_object($ad_creative)){
           Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_creative->getExceptionMessage());
            return redirect('/Exception/'.$ad_creative->getExceptionCode());
        }
        
        return redirect('ad/ad-creative');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fb_AdCreativeHelper $ad_adcreative_helper, $id)
    {
        $ad_creative = $this->fb_adcreative->destroy($ad_adcreative_helper, $id);
        
//        if ($this->fb_adcreative->destroy($ad_adcreative_helper, $id)) {
//            return redirect('ad/ad-creative');
//        }
        
               
        if(!is_object($ad_creative)){
           Session::flash('alert-success',Fb_AdUtilities::dumpDeleteSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_creative->getExceptionMessage());
            return redirect('/Exception/'.$ad_creative->getExceptionCode());
        }
        
         return redirect('ad/ad-creative');
    }
    
    public function selectCreate(){
        return view('admanager.adcreative.select');
    }
}
