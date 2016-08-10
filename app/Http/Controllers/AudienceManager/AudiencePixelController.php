<?php

namespace Allison\Http\Controllers\AudienceManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;

use Allison\Repositories\Contracts\IfFbAudiencePixel;

use Allison\models\FbAudience\AudiencePixel;

use Allison\AllisonFbApiHelpers\helpers\Fb_AudiencePixelHelper;

use Redirect;

use Session;

use Event;

use Auth;

use Allison\Events\FbAudienceSync\AudiencePixelReadEvent;

use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;

class AudiencePixelController extends Controller
{
    
    public function __construct(IfFbAudiencePixel $fb_audience_pixel)
    {
        $this->fb_audience_pixel = $fb_audience_pixel;
    }
    
    public function index(Fb_AudiencePixelHelper $audience_pixel_helper)
    {
      
        Event::fire(new AudiencePixelReadEvent($this->fb_audience_pixel, $audience_pixel_helper));
        
        $audience_pixel = $this->fb_audience_pixel->getPixelByAdAccountId(Auth::user()->fbAdAccount->id);
                
        return view('audience.pixel.index', compact('audience_pixel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('audience.pixel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fb_AudiencePixelHelper $audience_pixel_helper)
    {
        
        if(AudiencePixel::validate($request)->fails()){
            
            return Redirect::to('ad/audience-pixel/create')->withInput()->withErrors(AudiencePixel::validate($request));
            
        }else{
            
            if ($this->fb_audience_pixel->create($request, $audience_pixel_helper)) {
            
                    Session::flash('alert-success',Fb_AdUtilities::dumpCreateSuccessMessage());
            
            }
        
        }
        
         return redirect('ad/audience-pixel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fb_AudiencePixelHelper $audience_pixel_helper, $id)
    {
        //$audience_pixel = $this->fb_audience_pixel->getPixel($id);
        
        $this->fb_audience_pixel->syncAudiencePixelCode($audience_pixel_helper, $this->fb_audience_pixel->getPixel($id));
        
        $audience_pixel = $this->fb_audience_pixel->getPixel($id);
               
        return view('audience.pixel.show', compact('audience_pixel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $audience_pixel = $this->fb_audience_pixel->getPixel($id);
       
       return view('audience.pixel.update', compact('audience_pixel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fb_AudiencePixelHelper $audience_pixel_helper, $id)
    {
        
        if(AudiencePixel::validate($request)->fails()){
          
             return Redirect::to('ad/audience-pixel/'.$id.'/edit')->withInput()->withErrors(AudiencePixel::validate($request));
            
        }else{
           
            if ($this->fb_audience_pixel->update($request, $audience_pixel_helper, $id)) {
            
                    Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
            
            }
        
        }
        
         return redirect('ad/audience-pixel');
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
