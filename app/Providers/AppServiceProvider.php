<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Artisan;
use Modules\Admin\Models\Language;
use Modules\Admin\Models\Setting;
use Modules\Admin\Models\Contact;
use Jenssegers\Agent\Agent;
use auth ;
use Illuminate\Http\Request;
use Modules\Admin\Models\Advertisement;
use Illuminate\Routing\Controller;
class AppServiceProvider extends ServiceProvider
{
  
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        
        view()->composer('*', function($view) {
            // $view->with('user',auth('pharmacist')->user());
 
        });
 
        $langs = Language::active()->get();
        $websiteLang = Setting::where('settings_key', 'website_lang')->value('settings_value');

        $locales = $langs->pluck('locale')->toArray();
        $default = $locales[0];
        $localeSegment = request()->segment(1);
        if (in_array($localeSegment, $locales)) {
            app()->setLocale($localeSegment);
        } else {
            app()->setLocale($websiteLang);
        }

        $segment = request()->segment(3);
        $urlQuery = request()->query();
        // Get current Language
        $locale = app()->getLocale();
 
        // Get Language Direction
        $dir = $langs->firstWhere('locale', $locale)->dir;
         
        // dd( $locale ) ;
 
        $agent = new Agent();
        $contacts = Contact::first() ;
        $advertisements = Advertisement::all() ;
        view()->share(compact('segment', 'urlQuery', 'locale', 'dir', 'langs','agent','contacts','advertisements'));


        // view()->share(compact( 'locale', 'dir'));
    }
}
