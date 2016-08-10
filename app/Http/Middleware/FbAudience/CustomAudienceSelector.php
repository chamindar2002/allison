<?php

namespace Allison\Http\Middleware\FbAudience;

use Closure;
use Allison\models\FbAudience\AudienceCustom;

class CustomAudienceSelector
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
        $custom_audience = AudienceCustom::find($request->id);
        if($custom_audience->data_type != '')
            return redirect()->action('AudienceManager\CustomAudienceCustomerListController@edit', [$request->id]);
        
        return $next($request);
    }
}
