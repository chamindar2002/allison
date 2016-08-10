<?php
namespace Allison\Http\Controllers\AdManager;

use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAdSetRepository;
use Allison\Repositories\Contracts\IfFbAdcampaignsRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdSetHelper;
use Allison\Http\Requests\FbAdSetRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Illuminate\Routing\Route;
use Allison\Events\FbAdSync\FbAdSetReadEvent;
use Allison\models\FbAd\AdSet;

use Session;

use Event;

use Input;

class AdSetController extends Controller
{
    public function __construct(IfFbAdSetRepository $fb_adset, IfFbAdcampaignsRepository $fb_ad_campaign, AdSet $model)
    {
        $this->fb_adset = $fb_adset;
        $this->fb_ad_campaign = $fb_ad_campaign;
        $this->model = $model;
        $this->model->selected_defualt = 'LINK_CLICKS';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Fb_AdSetHelper $adset_helper)
    {
        $adsets = $this->fb_adset->getAllAdSets();
        Event::fire(new FbAdSetReadEvent($this->fb_adset, $adset_helper));
        return view('admanager.adset.index', compact('adsets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaigns = $this->fb_adset->listCampaigns($this->fb_ad_campaign->getAllCampaigns());

        $countries = $this->fb_adset->listCountries();

        $statuses = Config('facebook.STATUSES');
        
        $optimization_goals = Config('facebook.OPTIMIZATION_GOALS');

        $geo_locations = array();

        $results = array();
        
        $adset = $this->model;
        
        $target_groups = null;
        
        #flush session variable stored with selected groups
        Session::forget('selected_target_groups');
        
       
        return view('admanager.adset.create', compact('adset', 'campaigns', 'countries', 'statuses', 'geo_locations', 'results', 'optimization_goals', 'target_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdSetRequest $request, Fb_AdSetHelper $adset_helper)
    {
       
        
        $ad_set = $this->fb_adset->create($request, $adset_helper, $this->fb_ad_campaign);
        
                      
//        if ($this->fb_adset->create($request, $adset_helper, $this->fb_ad_campaign)) {
//             Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
//        }
       
        
        if(!is_object($ad_set)){
           Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_set->getExceptionMessage());
            return redirect('/Exception/'.$ad_set->getExceptionCode());
        }
        
        return redirect('ad/ad-set');
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
        $adset = $this->fb_adset->getAdSet($id);

        return view('admanager.adset.show', compact('adset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Fb_AdSetHelper $fb_adset_helper, $id)
    {
        $adset = $this->fb_adset->getAdSet($id);
        
        $target_groups = $adset->target_groups;
        
        Session::put('selected_target_groups', $target_groups);

        $countries = $this->fb_adset->listCountries();

        $statuses = Config('facebook.STATUSES');
        
        $optimization_goals = Config('facebook.OPTIMIZATION_GOALS');

        $campaigns = $this->fb_adset->listCampaigns($this->fb_ad_campaign->getAllCampaigns());

        $geo_locations = Fb_AdUtilities::unserialize_data($adset->geo_locations);
        
        $results = array();

        return view('admanager.adset.update', compact('adset', 'countries', 'statuses', 'campaigns', 'geo_locations', 'optimization_goals', 'results', 'target_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdSetRequest $request, Fb_AdSetHelper $adset_helper, $id)
    {
        $ad_set = $this->fb_adset->update($request, $adset_helper, $id);
        
//        if($this->fb_adset->update($request, $adset_helper, $id)){
//             Session::flash('alert-success',Fb_AdUtilities::dumpUpdateteSuccessMessage());
//        }
        
        if(!is_object($ad_set)){
           Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_set->getExceptionMessage());
            return redirect('/Exception/'.$ad_set->getExceptionCode());
        }
        
        return redirect('ad/ad-set');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fb_AdSetHelper $adset_helper, $id)
    {
        $ad_set = $this->fb_adset->destroy($adset_helper, $id);
        
//        if ($this->fb_adset->destroy($adset_helper, $id)) {
//            return redirect('ad/ad-set');
//        }
        
        //dd($ad_set);
         
        if(!is_object($ad_set)){
           Session::flash('alert-success',Fb_AdUtilities::dumpDeleteSuccessMessage());
        }else{
            Session::flash('alert-danger',$ad_set->getExceptionMessage());
            return redirect('/Exception/'.$ad_set->getExceptionCode());
        }

        return redirect('ad/ad-set');
    }

    public function ajxSearchTarget(Fb_AdSetHelper $fb_adset_helper, $text_target_search, Route $route)
    {
        $limit = Input::get('limit');
                
        $results = $this->fb_adset->cacheTargets($fb_adset_helper, trim($text_target_search), $adset = null, $limit);
        
        $search_target_id = null;
        
        $groups_selected = json_decode(Session::get('selected_target_groups'));
        
        //dd($groups_selected);
       
        return view('admanager.adset._interests', compact('results', 'search_target_id', 'groups_selected'));
    }
}
