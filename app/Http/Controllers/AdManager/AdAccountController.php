<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

use Allison\models\FbAd\AdAccount;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;

use Redirect;

use Auth;

use Session;

class AdAccountController extends Controller
{
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
         return view('admanager.adaccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(AdAccount::validate($request)->fails()){
            
            return Redirect::to('create-ad-account')->withInput()->withErrors(AdAccount::validate($request));
            
        }else{
            
            $ad_account = new AdAccount();
            $ad_account->ad_account_id = 'act_'.$request->ad_account_id;
            $ad_account->user_id = Auth::user()->id;
            $ad_account->save();
            
            Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
            
            return redirect('home');
        }
            
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
    public function edit()
    {//return AdSet::where('fb_profile_id', Auth::user()->fbProfile->id)->orderBy('id', 'desc')->get();
        $ad_account = AdAccount::find(Auth::user()->fbAdAccount->id);
        
        #strip off 'act_' string from ad account attribute
        $ad_account_id_strip = explode('act_', $ad_account->ad_account_id);
        
        $ad_account->ad_account_id = $ad_account_id_strip[1];
        //dd($ad_account_id_strip);
        
        return view('admanager.adaccount.update', compact('ad_account'));
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
        if(AdAccount::validate($request)->fails()){
            
            return Redirect::to('ad/default-ad-account')->withInput()->withErrors(AdAccount::validate($request));
            
        }else{
            
            $ad_account = AdAccount::find($id);
            $ad_account->ad_account_id = 'act_'.$request->ad_account_id;
            $ad_account->save();
            
            Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
            
            return redirect('home');
        }
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
