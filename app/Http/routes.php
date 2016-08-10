<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Auth\AuthController@getLogin');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('fetch-token', 'Auth\FbAccessTokenController@fetchAccessToken');
Route::get('auth/token-success', 'Auth\FbAccessTokenController@fetchTokenSuccess');

Route::get('create-ad-account', 'AdManager\AdAccountController@create')->middleware(['auth']);
Route::post('ad-account', 'AdManager\AdAccountController@store')->middleware(['auth']);
//Route::get('/home', array('uses' => 'Site\HomeController@index'))->middleware(['fb.acess-token']);

Route::get('/acl', array('uses' => 'Site\HomeController@acl_test'));

Route::get('user-registration', array('uses' => 'Register\UserRegistrationController@register'));
Route::post('user-registration', array('uses' => 'Register\UserRegistrationController@postRegister'));
Route::get('user-registration/{id}/edit', array('uses' => 'Register\UserRegistrationController@editRegister'));
Route::patch('user-registration-basic/{id}', array('uses' => 'Register\UserRegistrationController@updateRegisterBasic'));

//Route::resource('ad/ad-campaign', 'AdManager\AdCampaignController');
//Route::resource('ad/ad-set', 'AdManager\AdSetController');

Route::group(['middleware' => ['auth', 'fb.acess-token', 'fb.ad-account']], function()
{
   //Route::get('/home', array('uses' => 'Site\HomeController@index'))->middleware(['fb.acess-token']);
   Route::get('/home', array('uses' => 'Site\HomeController@index'));
   Route::get('/Exception/{code}', array('uses'=>'Site\ExceptionController@index'));
      
   Route::resource('ad/ad-campaign', 'AdManager\AdCampaignController');
   Route::resource('ad/ad-set','AdManager\AdSetController');

   //--------------------------media routes-------------------------------
   Route::resource('ad/ad-media','AdManager\AdMediaController');
   Route::get('ad/list-media','AdManager\AdMediaController@listMedia');

   Route::get('thumb-images/{image}', function($image = null)
   {
      $path = storage_path().'/ad-images/thumb_images/'.$image;
      return Response::download($path);

   });


   Route::post('ad/ad-media-video','AdManager\AdMediaController@uploadVideo');
   Route::get('ad/ad-media-video-thumbs/{id}', 'AdManager\AdMediaController@updateThumbUrl');
   Route::patch('ad/ad-media-video-thumbs/{id}', 'AdManager\AdMediaController@updateVideo');

   
   
   //--------------------------ad creative routes-------------------------------
   Route::get('ad/ad-creative/select/{id}', 'AdManager\AdCreativeController@select')->middleware(['fb.adcreative-selector']);
   Route::resource('ad/ad-creative', 'AdManager\AdCreativeController');
   Route::get('ad/ad-creative-create-select', 'AdManager\AdCreativeController@selectCreate');
   Route::resource('ad/ad-creative-call-to-action','AdManager\AdCreativeCallToActionController');
   Route::resource('ad/ad-creative-page-link', 'AdManager\AdCreativeLinkAdController');
   Route::resource('ad/ad-creative-video-page', 'AdManager\AdCreativeVideoPageController');
   Route::resource('ad/ad-creative-existing-post', 'AdManager\AdCreativePagePostController');
   Route::resource('ad/ad-creative-carousel-ad', 'AdManager\AdCreativeCarouselAdController');
   //--------------------------end of creative routes----------------------------

   //--------------------------product routes-------------------------------
   Route::resource('ad/ad-products', 'AdManager\AdCreativeProductsController');
   Route::get('ad/ad-products-list','AdManager\AdCreativeProductsController@listProducts');

   
   Route::resource('ad/ad-publish', 'AdManager\AdPublishController');
   Route::get('ad/default-ad-account', 'AdManager\AdAccountController@edit');
   Route::patch('ad/default-ad-account/{id}', 'AdManager\AdAccountController@update');
   
   Route::resource('ad/audience-pixel', 'AudienceManager\AudiencePixelController');
   Route::get('ad/create-select', 'AudienceManager\CustomAudienceController@selectCreate');
   //Route::resource('ad/audience-custom', 'AudienceManager\CustomAudienceController');
   Route::resource('ad/audience-custom-customer-list', 'AudienceManager\CustomAudienceCustomerListController');
   Route::resource('ad/audience-lookalike', 'AudienceManager\LookalikeAudienceController');
   
   Route::get('ad/audience-custom/{id}/edit', 'AudienceManager\CustomAudienceController@edit')->middleware(['fb.audience-selector']);
   Route::get('ad/audience-custom', 'AudienceManager\CustomAudienceController@index');
   Route::get('ad/audience-custom/create', 'AudienceManager\CustomAudienceController@create');
   Route::post('ad/audience-custom', 'AudienceManager\CustomAudienceController@store');
   Route::patch('ad/audience-custom/{id}', 'AudienceManager\CustomAudienceController@update');
   Route::get('ad/audience-custom/{id}', 'AudienceManager\CustomAudienceController@show');
   Route::delete('ad/audience-custom/{id}', 'AudienceManager\CustomAudienceController@destroy');
   Route::get('ad-wizard', 'AdManager\AdWizardController@start');
//   Route::get('ad-wizard/{next}', 'AdManager\AdWizardController@next');
//   Route::get('ad-wizard/{prev}', 'AdManager\AdWizardController@prev');
   
});


#api Routes
Route::group(['prefix' => 'Api', 'middleware'=>['fb.auth-check']], function () {

   Route::get('wz-campagin', 'AdManager\AdWizardController@getCampaigns');
   Route::post('wz-campagin', 'AdManager\AdWizardController@storeCampaigns');

   Route::get('wz-search-targets', 'AdManager\AdWizardController@searchTargets');

   Route::post('wz-adset', 'AdManager\AdWizardController@storeAdSets');
   Route::get('wz-adset', 'AdManager\AdWizardController@getAdsets');

   Route::get('wz-adcreative', 'AdManager\AdWizardController@getAdCreatives');
   Route::post('wz-adcreative', 'AdManager\AdWizardController@storeAdCreatives');

   Route::get('wz-ad', 'AdManager\AdWizardController@getAds');
   Route::post('wz-ad', 'AdManager\AdWizardController@storeAds');

   Route::post('wz-adcreative-page-link-ad','AdManager\AdWizardController@storeAdCreativesPageLink');

   Route::post('wz-adcreative-callto-action-ad','AdManager\AdWizardController@storeAdCreativesCalltoAction');

   Route::post('wz-adcreative-video-pagelike-ad', 'AdManager\AdWizardController@storeAdVideoPageLike');

   Route::post('wz-adcreative-page-post-ad', 'AdManager\AdWizardController@storeAdPagePost');

   Route::post('wz-adcreative-carousal-ad', 'AdManager\AdWizardController@storeAdCarousal');

//   Route::post('wz-adcreative', function(){
//     return json_encode(['cat','dog', 'cow', 'horse']);
//   });



});

/*Route::group(['middleware' => 'fb.target-search'], function()
{
   Route::resource('ad/ad-set','AdManager\AdSetController');
});*/

#ajax routes
Route::get('ad/audience-custom/{id}/edit', 'AudienceManager\CustomAudienceController@edit')->middleware(['fb.audience-selector']);

Route::get('ad/ajx-request-target-interest/{text_target_search}', array('uses' => 'AdManager\AdSetController@ajxSearchTarget'));

Route::get('request-app-permission', array('uses'=>'Site\ExceptionController@sendAppPermissionRequest'));

Route::get('reset-fb-access-token', array('uses'=>'Site\ExceptionController@resetFbAccessToken'));


#ajax routes

Route::get('video-thumb-url', 'AdManager\AdCreativeVideoPageController@fetchThumbImageUrl')->middleware(['fb.auth-check']);
Route::get('list-page-posts', 'AdManager\AdCreativePagePostController@fetchPagePosts');

Route::get('ad/ad-media/jq-file-upload', 'AdManager\AdMediaController@ajxUploadFile');
Route::post('ad/ad-media/jq-file-upload', 'AdManager\AdMediaController@ajxUploadFile');