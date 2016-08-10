<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAdCreativeRepository;
use Allison\Repositories\Contracts\IfFbAdMediaRepository;
use Allison\Repositories\Contracts\IfFbAdProductsRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdCreativeHelper;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Http\Requests\FbAdCreativeCallToActionRequest;
use Session;
use Illuminate\Support\Facades\Input;


class AdCreativeCarouselAdController extends Controller
{

    public function __construct(IfFbAdCreativeRepository $fb_adcreative, IfFbAdMediaRepository $fb_admedia, IfFbAdProductsRepository $fb_products)
    {
        $this->fb_adcreative = $fb_adcreative;
        $this->fb_admedia = $fb_admedia;
        $this->fb_products = $fb_products;

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
        $products = $this->fb_products->getAllProducts();
        $path = Fb_AdUtilities::thumbview_media_path();
        $media_config = Config('facebook.MEDIA_IMAGES');

        return view('admanager.adcreative-carousel-ad.create', compact('products', 'path', 'media_config', 'checked_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdCreativeCallToActionRequest $request, IfFbAdProductsRepository $fb_products, Fb_AdCreativeHelper $ad_adcreative_helper)
    {
        $ad_creative = $this->fb_adcreative->createCarouselAd($request, $fb_products, $ad_adcreative_helper);

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
        $products = $this->fb_products->getAllProducts();
        $path = Fb_AdUtilities::thumbview_media_path();
        $media_config = Config('facebook.MEDIA_IMAGES');

        $checked_products = $this->fb_adcreative->listProducts($adcreative);


        return view('admanager.adcreative-carousel-ad.update', compact('adcreative', 'products', 'path', 'media_config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdCreativeCallToActionRequest $request,
                           IfFbAdProductsRepository $fb_products,
                           Fb_AdCreativeHelper $ad_adcreative_helper, $id){

        $ad_creative = $this->fb_adcreative->updateCarouselAd($request, $fb_products, $ad_adcreative_helper, $id);

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
