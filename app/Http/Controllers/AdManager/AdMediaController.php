<?php

namespace Allison\Http\Controllers\AdManager;

use Illuminate\Http\Request;
use Allison\Http\Requests;
use Allison\Http\Controllers\Controller;
use Allison\Repositories\Contracts\IfFbAdMediaRepository;
use Allison\models\FbAd\AdMedia;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities;
use Allison\AllisonFbApiHelpers\helpers\Fb_AdMediaHelper;
use Allison\Events\FbAdSync\FbAdMediaReadEvent;
use Event;
#temp
use Input;
//use Validator;
use Redirect;
use Session;
use Image;
use URL;
use Response;


class AdMediaController extends Controller
{
    
    public function __construct(IfFbAdMediaRepository $fb_media)
    {
        $this->fb_media = $fb_media;

        ini_set('max_execution_time', 0);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $media = $this->fb_media->getAllAdMedia(false);
        
        $path = Fb_AdUtilities::thumbview_media_path();
        
        $media_config = Config('facebook.MEDIA_IMAGES');
        
        //Event::fire(new FbAdMediaReadEvent($this->fb_media, $admedia_helper));

        //return view('admanager.admedia.index', compact('media', 'path', 'media_config'));

        $media = $this->fb_media->getAllAdMedia();

        $path = Fb_AdUtilities::thumbview_media_path();

        $media_config = Config('facebook.MEDIA_IMAGES');

        $route_to_file = URL::to('/').'/thumb-images/';

        $file = '';
        $type = '';
        $file_ext = '';

        $image_files = array();

        foreach($media as $md){

            if(!file_exists($path.$md->media_file)){

                if($md->url_128 != ''){
                    $file = $md->url_128;

                }else{
                    #if remote url is also not available, display no image image
                    $file = $route_to_file.$media_config['NO_IMAGE'];


                }
                $file_ext = $media_config['NO_IMAGE_TYPE'];



            }else{

                $file = $route_to_file.$md->media_file;
                $file_ext = $md->media_extension;

            }

            $type = $md->type;

            $image_files[] = array(
                'id'=>$md->id,
                'media_file'=>$md->media_file,
                'original_file_name'=>$md->original_file_name,
                'file_path'=>$file,
                'type'=>$type,
                'file_extension' => $file_ext,
                'width'=>$media_config['THUMB_SIZE_W'],
                'height'=> $media_config['THUMB_SIZE_H']
            );

        }

        return  Response::json($image_files, 200, [], JSON_NUMERIC_CHECK);


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admanager.admedia.create');
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fb_AdMediaHelper $admedia_helper){
        
        //dd($request);
        $file = array('media_file'=> $request->file('media_file'));
        
        $media_config = Config('facebook.MEDIA_IMAGES');

        //var_dump(Input::all());exit;

        //var_dump($file);exit;
                
        if(AdMedia::validate($file)->fails()){

            if($request->ajax()){
                //dd(AdMedia::validate($file)->errors()->all()[0]);
                //sleep(5);
                return ['status'=>'error', 'message'=> ['error_message'=>AdMedia::validate($file)->errors()->all()[0]], 'error_code'=> null,'data' => null];

            }

            return Redirect::to('ad/ad-media/create')->withInput()->withErrors(AdMedia::validate($file));
            
        }else{


            if($request->hasFile('media_file')){
                
                #no problems uploading 
                if($request->file('media_file')->isValid()){
                    
                    $file_size = $request->file('media_file')->getSize();
                    $extension = Input::file('media_file')->getClientOriginalExtension(); // getting media_file extension
                    $fileName = Fb_AdUtilities::generateUniqueFileName().'.'.$extension; // renaming media_file
                    
                    //$request->file('media_file')->move(Fb_AdUtilities::media_path(), $fileName);
                    
                   
                    #save full size images
                    $img = Image::make($request->file('media_file'));
                    //$img->fit($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                    $img->save(Fb_AdUtilities::fullview_media_path().$fileName);
                              
                    #save thumb size images
                    $img = Image::make($request->file('media_file'));
                    $img->fit($media_config['THUMB_SIZE_W'], $media_config['THUMB_SIZE_H']);
                    $img->save(Fb_AdUtilities::thumbview_media_path().$fileName);
                    
                    
                    //$this->fb_media->create($request, $fileName, $file_size, $admedia_helper);
                    
                    Session::flash('alert-success', 'Upload successfull'); 
                    
                    if ($this->fb_media->create($request, $fileName, $file_size, $admedia_helper)) {

                        if($request->ajax()){
                            return['status'=>'success', 'message'=> ['message'=>'Upload successfull'], 'data' => null];
                        }

                        return Redirect::to('ad/ad-media/create');
                    }
                    
                    
                }else {

                    if($request->ajax()){
                                    return ['status'=>'error', 'message'=> ['error_message'=>'uploaded file is not valid'], 'error_code'=> null,'data' => null];

                    }
                    // sending back with error message.
                    Session::flash('alert-danger', 'uploaded file is not valid');
                    //return Redirect::to('ad/ad-media/create');
                }
            }
            
        }

        if(!$request->ajax())
            return Redirect::to('ad/ad-media/create');
        
    }
    
    
    public function store_temp(Request $request)
    {
        $file = array('media_file' => Input::file('media_file'));
        
        $rules = array('media_file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
          // send back to the page with the input data and errors
          return Redirect::to('ad/ad-media/create')->withInput()->withErrors($validator);
          
        }else {
            // checking file is valid.
            if (Input::file('media_file')->isValid()) {
              $destinationPath = storage_path().'\ad-images\\'; // upload path
              $extension = Input::file('media_file')->getClientOriginalExtension(); // getting media_file extension
              $fileName = Fb_AdUtilities::generateUniqueFileName().'.'.$extension; // renameing media_file
              Input::file('media_file')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message
              Session::flash('success', 'Upload successfully'); 
              return Redirect::to('ad/ad-media/create');
            }
            else {
              // sending back with error message.
              Session::flash('error', 'uploaded file is not valid');
              return Redirect::to('ad/ad-media/create');
            }
        }
        
        dd($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = $this->fb_media->getAdMedia($id);
        
        $path = Fb_AdUtilities::thumbview_media_path();
        
        $media_config = Config('facebook.MEDIA_IMAGES');
        
        return view('admanager.admedia.show', compact('media', 'path', 'media_config'));
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
    public function destroy(Fb_AdMediaHelper $admedia_helper, $id)
    {
        if ($this->fb_media->destroy($admedia_helper, $id))
        {
            Session::flash('alert-success', 'File removed succcessfully'); 
            return redirect('ad/ad-media');
        }
        
        Session::flash('alert-danger', 'Failed to remove file ');
        return Redirect::to('ad/list-media');
    }

    public function uploadVideo(Request $request, Fb_AdMediaHelper $admedia_helper){


        $file = array('media_file'=> $request->file('media_file'));

        //dd($request);
        $media_config = Config('facebook.MEDIA_IMAGES');

        //dd($_FILES);

        if(AdMedia::validate($file, $request->media_type)->fails()){

            if($request->ajax()){

                return ['status'=>'error', 'message'=> ['error_message'=>AdMedia::validate($file)->errors()->all()[0]], 'error_code'=> null,'data' => null];

            }

            return Redirect::to('ad/ad-media/create')->withInput()->withErrors(AdMedia::validate($file, $request->media_type));

        }else{

            if (Input::file('media_file')->isValid()) {

                $file_size = $request->file('media_file')->getSize();

                $extension = Input::file('media_file')->getClientOriginalExtension(); // getting media_file extension
                $fileName = Fb_AdUtilities::generateUniqueFileName().'.'.$extension; // renaming media_file

                //$img = Image::make($request->file('media_file'));
                //$video->save(Fb_AdUtilities::fullview_media_path().$fileName);
                //dd($fileName);
                Input::file('media_file')->move(Fb_AdUtilities::video_media_path(), $fileName);

                Session::flash('alert-success', 'Upload successfull');

                $media = $this->fb_media->createVideo($request, $fileName, $file_size, $admedia_helper);

                if ($media) {

                    if($request->ajax()){
                        return['status'=>'success', 'message'=> ['message'=>'Upload successfull'], 'data' => null];
                    }

                    return Redirect::to('ad/ad-media-video-thumbs/'.$media->id);
                }

            }else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');

                if($request->ajax()){
                    return ['status'=>'error', 'message'=> ['error_message'=>'uploaded file is not valid'], 'error_code'=> null,'data' => null];

                }

                //return Redirect::to('ad/ad-media/create');
            }
        }

        if(!$request->ajax())
            return Redirect::to('ad/ad-media/create');

    }

    public function updateThumbUrl(Fb_AdMediaHelper $admedia_helper, $id){

        $media = $this->fb_media->getAdMedia($id);

        $thumb_images = $admedia_helper->fetchThumbImages($media->video_id);

        sleep(3);

        return view('admanager.admedia.update', compact('thumb_images','media'));
    }

    public function updateVideo(Request $request, $id){


        $ad_video = $this->fb_media->updateVideo($request, $id);


        if($ad_video){
            Session::flash('alert-success',Fb_AdUtilities::dumpUpdateSuccessMessage());
        }else{
            Session::flash('alert-danger',Fb_AdUtilities::dumpFailMessage());
            return Redirect::to('ad/ad-media/create');
        }

        return Redirect::to('ad/ad-media/create');

    }

    public function ajxUploadFile(){
        return 'xyz'; #temp
    }



    public function listMedia(Fb_AdMediaHelper $admedia_helper){
        Event::fire(new FbAdMediaReadEvent($this->fb_media, $admedia_helper));
        return view('admanager.admedia.index');


    }
}
