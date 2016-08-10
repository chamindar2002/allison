<?php

namespace Allison\Http\Controllers\AdManager;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\Repositories\Contracts\IfFbAdMediaRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Http\Requests\FbAdCreativeCallToActionRequest;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdCreativeHelper;

use Session;

class AdCreativeCallToActionController extends Controller
{
    private $call_to_action_types =  array();
    
    public function __construct(IfFbAdCreativeRepository $fb_adcreative, IfFbAdMediaRepository $fb_admedia)
    {
        $this->fb_adcreative = $fb_adcreative;
        $this->fb_admedia = $fb_admedia;
        
        $this->call_to_action_types = Config('facebook.CALL_TO_ACTION_TYPES');
        unset($this->call_to_action_types['LIKE_PAGE']); # is used in: Create a Video Page Like ad
        unset($this->call_to_action_types['DOWNLOAD']); # throws an unknownd error
        unset($this->call_to_action_types['GET_DIRECTIONS']); # throws an unknownd error
     
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
        $call_to_action_types = $this->call_to_action_types;
        
       
        return view('admanager.adcreative-cltoaction.create', compact('call_to_action_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper)
    {
        $ad_creative = $this->fb_adcreative->createCallToAction($request, $ad_adcreative_helper);
        
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
        $adcreative = $this->fb_adcreative->getAdCreative($id);
        
        $call_to_action_types = $this->call_to_action_types;
        
        return view('admanager.adcreative-cltoaction.update', compact('call_to_action_types', 'adcreative'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper, $id)
    {
        $ad_creative = $this->fb_adcreative->updateCallToAction($request, $ad_adcreative_helper, $id);
    
        
        if(!is_object($ad_creative)){
           Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
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
    public function destroy($id)
    {
        //
    }
}
