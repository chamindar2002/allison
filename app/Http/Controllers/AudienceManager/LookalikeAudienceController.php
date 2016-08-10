<?php

namespace Allison\Http\Controllers\AudienceManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAudienceCustom;
use Allison\Repositories\Contracts\IfFbAudienceLookalike;
use Allison\Repositories\Contracts\IfFbAdSetRepository;
use Allison\Http\Requests\FbAudienceLookalikeRequest;
use Allison\AllisonFbApiHelpers\helpers\Fb_AudienceLookalikeHelper;


class LookalikeAudienceController extends Controller
{
    
    public function __construct(IfFbAudienceCustom $fb_audience_custom,
                                IfFbAudienceLookalike $fb_audience_lookalike,
                                IfFbAdSetRepository $fb_adset,
                                IfFbAudienceCustom $fb_audience_custom
                                ){
        
        $this->fb_audience_custom = $fb_audience_custom;
        $this->fb_audience_lookalike = $fb_audience_lookalike;
        $this->fb_adset = $fb_adset;
        $this->fb_audience_custom = $fb_audience_custom;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lookalike_audience = $this->fb_audience_lookalike->getAllLookalikeAudiences();
        
        return view('audience.lookalike.index', compact('lookalike_audience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $custom_audiences = $this->fb_audience_custom->listCustomAudiences();
        
        $countries = $this->fb_adset->listCountries()->toArray();
                
        return view('audience.lookalike.create', compact('custom_audiences', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAudienceLookalikeRequest $request, Fb_AudienceLookalikeHelper $audience_lookalike_helper)
    {
        if ($this->fb_audience_lookalike->create($request, $audience_lookalike_helper, $this->fb_audience_custom)) {
             Session::flash('alert-success', Fb_AdUtilities::dumpCreateSuccessMessage());
        }
        
        return redirect('ad/audience-lookalike');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
