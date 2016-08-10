<?php

namespace Allison\Http\Controllers\AdManager;

use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAdcampaignsRepository;
use Allison\Http\Requests\FbAdCampaignRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdCampaignHelper;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdWizard;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Session;

class AdCampaignController extends Controller
{
    public function __construct(IfFbAdcampaignsRepository $fb_ad_campaign)
    {
        $this->fb_ad_campaign = $fb_ad_campaign;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->fb_ad_campaign->getAllCampaigns();


        return view('admanager.adcampaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objectives = Config('facebook.OBJECTIVES');
        $statuses = Config('facebook.STATUSES');

        return view('admanager.adcampaign.create', compact('objectives', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdCampaignRequest $request, Fb_AdCampaignHelper $ad_campaign_helper)
    {
        $ad_campaign = $this->fb_ad_campaign->create($request, $ad_campaign_helper);
        
        //dd($ad_campaign);
        
        if(!is_object($ad_campaign)){
           Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_campaign->getExceptionMessage());
            return redirect('/Exception/'.$ad_campaign->getExceptionCode());
        }
        
        return redirect('ad/ad-campaign');
        

        //echo $request->input('name');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = $this->fb_ad_campaign->getCampaign($id);

        return view('admanager.adcampaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = $this->fb_ad_campaign->getCampaign($id);
        $objectives = Config('facebook.OBJECTIVES');
        $statuses = Config('facebook.STATUSES');
        //unset($statuses['STATUS_DELETED']);
        //dd($campaigns);
        return view('admanager.adcampaign.update', compact('campaign', 'objectives', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdCampaignRequest $request, Fb_AdCampaignHelper $ad_campaign_helper, $id)
    {
//        if ($this->fb_ad_campaign->update($request, $ad_campaign_helper, $id)) {
//            Session::flash('alert-success',Fb_AdUtilities::dumpUpdateteSuccessMessage());
//            return redirect('ad/ad-campaign');
//        }
        
        $ad_campaign = $this->fb_ad_campaign->update($request, $ad_campaign_helper, $id);
        
                      
            
        if(!is_object($ad_campaign)){
             Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
        }else{
             Session::flash('alert-danger',$ad_campaign->getExceptionMessage());
             return redirect('/Exception/'.$ad_campaign->getExceptionCode());
        }
        
         return redirect('ad/ad-campaign');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fb_AdCampaignHelper $ad_campaign_helper, $id)
    {
        
        $ad_campaign = $this->fb_ad_campaign->destroy($ad_campaign_helper, $id);
        
           
            
            if(!is_object($ad_campaign)){
                Session::flash('alert-success',Fb_AdUtilities::dumpDeleteSuccessMessage());
            }else{
                 Session::flash('alert-danger',$ad_campaign->getExceptionMessage());
                 return redirect('/Exception/'.$ad_campaign->getExceptionCode());
            }
            
        return redirect('ad/ad-campaign');
        
    }
}
