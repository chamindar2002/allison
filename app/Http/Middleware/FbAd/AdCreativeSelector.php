<?php

namespace Allison\Http\Middleware\FbAd;

use Closure;

use Allison\models\FbAd\AdCreative;

class AdCreativeSelector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * redirect to CustomAudienceCustomerListController if record is a customer list type
         */
        $ad_creative = AdCreative::find($request->id);
        
        if($ad_creative->ad_type == 'link_ad'){
            return redirect()->action('AdManager\AdCreativeController@edit', [$request->id]);
        }elseif($ad_creative->ad_type == 'link_ad_call_to_action'){
            return redirect()->action('AdManager\AdCreativeCallToActionController@edit', [$request->id]);
        }elseif($ad_creative->ad_type == 'link_ad_connected_to_page'){
            return redirect()->action('AdManager\AdCreativeLinkAdController@edit', [$request->id]);
        }elseif($ad_creative->ad_type == 'video_page_like_ad'){
            return redirect()->action('AdManager\AdCreativeVideoPageController@edit', [$request->id]);
        }elseif($ad_creative->ad_type == 'ad_from_existing_page_post'){
            return redirect()->action('AdManager\AdCreativePagePostController@edit', [$request->id]);    
        }elseif($ad_creative->ad_type == 'carousel_ad'){
            return redirect()->action('AdManager\AdCreativeCarouselAdController@edit', [$request->id]);
        }else{
            die('no ad type found');#temporary
        }
        
        return $next($request);
    }
}
