<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;

use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Input;
use Allison\Repositories\Contracts\IfFbAdProductsRepository;
use Allison\Repositories\Contracts\IfFbAdMediaRepository;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\Http\Requests\FbAdProductRequest;
use Response;
use URL;

class AdCreativeProductsController extends Controller
{

    public function __construct(IfFbAdMediaRepository $fb_media, IfFbAdProductsRepository $fb_products)
    {
        $this->fb_media = $fb_media;
        $this->fb_products = $fb_products;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->fb_products->getAllProducts();

        return view('admanager.adproducts.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = $this->fb_media->getAllAdMedia();

        $path = Fb_AdUtilities::thumbview_media_path();

        $media_config = Config('facebook.MEDIA_IMAGES');

        $checked_media = array();

        return view('admanager.adproducts.create', compact('media', 'path', 'media_config', 'checked_media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FbAdProductRequest $request)
    {
        $products= $this->fb_products->create($request);

        if($products){
            Session::flash('alert-success', Fb_AdUtilities::dumpCreateSuccessMessage());
        }else{
            Session::flash('alert-danger', Fb_AdUtilities::dumpFailMessage());
        }

        return redirect('ad/ad-products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->fb_products->getProduct($id);

        return view('admanager.adproducts.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->fb_products->getProduct($id);

        $media = $this->fb_media->getAllAdMedia();

        $path = Fb_AdUtilities::thumbview_media_path();

        $media_config = Config('facebook.MEDIA_IMAGES');

        $checked_media = array();

        return view('admanager.adproducts.update', compact('product', 'media', 'path', 'media_config', 'checked_media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FbAdProductRequest $request, $id)
    {
        $products = $this->fb_products->update($request, $id);


        if($products){
            Session::flash('alert-success', Fb_AdUtilities::dumpUpdateSuccessMessage());
        }else{
            Session::flash('alert-danger', Fb_AdUtilities::dumpFailMessage());
        }

        return redirect('ad/ad-products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = $this->fb_products->destroy($id);

        if($products){
            Session::flash('alert-success', Fb_AdUtilities::dumpDeleteSuccessMessage());
        }else{
            Session::flash('alert-danger', Fb_AdUtilities::dumpFailMessage());
        }

        return redirect('ad/ad-products');
    }

    public function listProducts()
    {
        $products = $this->fb_products->getAllProducts();

        $products_list = array();
        $file = '';
        $route_to_file = URL::to('/').'/thumb-images/';
        $path = Fb_AdUtilities::thumbview_media_path();
        $media_config = Config('facebook.MEDIA_IMAGES');

        foreach($products As $product){

            if (!file_exists($path . $product->media->media_file)) {
                #if file not exists locally fetch it from remote url
                if ($product->media->url_128 != '') {
                    $file = $product->media->url_128;
                } else {
                    #if remote url is also not available, display no image image
                    $file = $route_to_file.$media_config['NO_IMAGE'];
                }
                $type = $media_config['NO_IMAGE_TYPE'];
            } else {
                $file = $route_to_file . $product->media->media_file;
                $type = $product->media_type;
            }



            $products_list[] = array(
              'id'=>$product->id,
              'product_name'=>$product->product_name,
              'product_description'=>$product->product_description,
              'file_path'=>$file,
              'width'=>$media_config['THUMB_SIZE_W'],
              'height'=> $media_config['THUMB_SIZE_H']
              //''=>$product-> ,
              //''=>$product-> ,
            );
        }

        return  Response::json($products_list, 200, [], JSON_NUMERIC_CHECK);
    }
}
