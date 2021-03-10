<?php

namespace App\Http\Middleware;
use Modules\Ecommerce\Models\Order ;
use Modules\Ecommerce\Models\Cart ;
use Modules\Ecommerce\Models\Favorite ;
use Auth ;
use Closure;
use Modules\Admin\Models\Language;

class LocaleRedirect
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
        // session_start();
        $langs = Language::active()->pluck('locale')->toArray();
        $default = $langs[0];
        $locale = $request->segment(1);
        
        if (in_array($locale, $langs)) {
            return $next($request);
        } else {
            if (isset($_SESSION['localeCode'])) {
                if (in_array($_SESSION['localeCode'], $langs)) {
                    $lang = $_SESSION['localeCode'];
                } else {
                    $lang = $default;
                }
            } else {
                $_SESSION['localeCode'] = $default;
                $lang = $default;
            }
            $newUrl = str_replace(env('APP_URL'), env('APP_URL').'/'. $lang, $request->fullUrl());
            
            return redirect($newUrl);
        }
    }
}
