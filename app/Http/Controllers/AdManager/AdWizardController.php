<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdWizard;

use Allison\Repositories\Contracts\IfFbAdcampaignsRepository;
use Allison\Http\Requests\FbAdCampaignRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdCampaignHelper;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Repositories\Contracts\IfFbAdSetRepository;
use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdSetHelper;
use Allison\Http\Requests\FbAdSetRequest;
use Allison\Http\Requests\FbAdCreativeRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdCreativeHelper;
use Allison\Http\Requests\FbAdCreativeCallToActionRequest;
use Allison\Repositories\Contracts\IfFbAdProductsRepository;
use Allison\Repositories\Contracts\IfFbAdPublishRepository;
use Allison\Http\Requests\FbAdPublishRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdPublishHelper;


use Response;
use Input;

class AdWizardController extends Controller
{
    
    private $wizard;
    private $call_to_action_types =  array();

    public function __construct(
                                Fb_AdWizard $wizard,
                                IfFbAdcampaignsRepository $fb_ad_campaign,
                                IfFbAdSetRepository $fb_adset,
                                IfFbAdCreativeRepository $fb_adcreative,
                                IfFbAdPublishRepository $fb_adpublish
                            ){

        $this->fb_ad_campaign = $fb_ad_campaign;
        $this->wizard = $wizard;
        $this->fb_adset = $fb_adset;
        $this->fb_adcreative = $fb_adcreative;
        $this->fb_adpublish = $fb_adpublish;

        $this->call_to_action_types = Config('facebook.CALL_TO_ACTION_TYPES');

        unset($this->call_to_action_types['DOWNLOAD']); # throws an unknownd error
        unset($this->call_to_action_types['GET_DIRECTIONS']); # throws an unknownd error
        unset($this->call_to_action_types['LIKE_PAGE']); # is used in: Create a Video Page Like ad
    }

    
    public function start(){
        
        //$current = $this->wizard->getCurrentModule();
        //return redirect($current['next']);

        $objectives = Config('facebook.OBJECTIVES');
        $statuses = Config('facebook.STATUSES');
        $submitButtonText = 'OK';

        $countries = $this->fb_adset->listCountries();
        $geo_locations = array();
        $optimization_goals = Config('facebook.OPTIMIZATION_GOALS');
        $statuses = Config('facebook.STATUSES');

        $call_to_action_types = $this->call_to_action_types;


        return view('admanager.wizard.index',
                compact(
                    'objectives',
                    'statuses',
                    'submitButtonText',
                    'countries',
                    'geo_locations',
                    'optimization_goals',
                    'statuses',
                    'call_to_action_types'

                )
        );


    }

    public function searchTargets(Request $request, Fb_AdSetHelper $fb_adset_helper){

        $limit = $request->searchLimit;
        $text_target_search = $request->searchText;
        $results = $this->fb_adset->cacheTargets($fb_adset_helper, trim($text_target_search), $adset = null, $limit);

        $data = array();

        foreach($results As $rs){
            $data[] = ['id'=> $rs->id,'name' => $rs->name];
        }

        return  Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }



    public function getCampaigns(){

        $campaigns = $this->fb_ad_campaign->getAllCampaigns(false);
        return  Response::json($campaigns, 200, [], JSON_NUMERIC_CHECK);
    }


    public function storeCampaigns(FbAdCampaignRequest $request, Fb_AdCampaignHelper $ad_campaign_helper){

        $ad_campaign = $this->fb_ad_campaign->create($request, $ad_campaign_helper);

        if(!is_object($ad_campaign)){

            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => null]);
        }else{

            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_campaign->getExceptionMessage()], 'error_code'=> $ad_campaign->getExceptionCode(),'data' => null]);

        }

    }

    public function getAdsets(){
        $adsets = $this->fb_adset->getAllAdSets(false);
        return  Response::json($adsets, 200, [], JSON_NUMERIC_CHECK);
    }

    public function storeAdSets(FbAdSetRequest $request, Fb_AdSetHelper $adset_helper){

        $ad_set = $this->fb_adset->create($request, $adset_helper, $this->fb_ad_campaign);

        if(!is_object($ad_set)){

            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_set]);

        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_set->getExceptionMessage()], 'error_code'=> $ad_set->getExceptionCode(),'data' => null]);
        }

        return json_encode(['dog','cat']);
    }

    public function getAdCreatives(){
        $ad_creatives = $this->fb_adcreative->getAllAdCreatives(false);
        return  Response::json($ad_creatives, 200, [], JSON_NUMERIC_CHECK);
    }

    public function storeAdCreatives(FbAdCreativeRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->create($request, $ad_adcreative_helper);

        if(!is_object($ad_creative)){

            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);

        }else{

            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);

        }

    }

    public function storeAdCreativesPageLink(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->createLinkAd($request, $ad_adcreative_helper);

        if(!is_object($ad_creative)){
            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);
        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);
        }

        return redirect('ad/ad-creative');

    }

    public function storeAdCreativesCalltoAction(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->createCallToAction($request, $ad_adcreative_helper);

        if(!is_object($ad_creative)){
            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);
        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);
        }

    }

    public function storeAdVideoPageLike(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->createVideoPageLikeAd($request, $ad_adcreative_helper);

        if(!is_object($ad_creative)){

            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);
        }else{

            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);
        }

    }

    public function storeAdPagePost(FbAdCreativeCallToActionRequest $request, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->createPagePostAd($request, $ad_adcreative_helper);

        if(!is_object($ad_creative)){
            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);
        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);
        }


    }

    public function storeAdCarousal(FbAdCreativeCallToActionRequest $request, IfFbAdProductsRepository $fb_products, Fb_AdCreativeHelper $ad_adcreative_helper){

        $ad_creative = $this->fb_adcreative->createCarouselAd($request, $fb_products, $ad_adcreative_helper);

        if(!is_object($ad_creative)){
            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad_creative]);
        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad_creative->getExceptionMessage()], 'error_code'=> $ad_creative->getExceptionCode(),'data' => null]);
        }

    }

    public function getAds(){

        $ads = $this->fb_adpublish->getAllAds();
        return  Response::json($ads, 200, [], JSON_NUMERIC_CHECK);
    }

    public function storeAds(FbAdPublishRequest $request, Fb_AdPublishHelper $ad_adpublish_helper){

        $ad = $this->fb_adpublish->create($request, $ad_adpublish_helper, $this->fb_adset, $this->fb_adcreative);

        $ad->getExceptionMessage();

        if(!is_object($ad)){
            return json_encode(
                ['status'=>'success', 'message'=> [Fb_AdUtilities::dumpCreateSuccessMessage()], 'data' => $ad]);
        }else{
            return json_encode(
                ['status'=>'error', 'message'=> ['error_message'=>$ad->getExceptionMessage()], 'error_code'=> $ad->getExceptionCode(),'data' => null]);
        }

    }


}
