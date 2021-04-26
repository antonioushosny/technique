<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Ecommerce\Models\Cart;
use Modules\Admin\Models\Language;
use auth ;
use Carbon\Carbon ;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

 
    protected function notification($device_id ,$type,$title,$msg)
    {
         
        $path_to_fcm='https://fcm.googleapis.com/fcm/send';
        $locale = app()->getLocale();
        $server_key= env('FCM_API_KEY');
        $key = $device_id;
        $message = $msg;
        $title = $title ;
        $headers = array('Authorization:key=' .$server_key,'Content-Type:application/json');
        if( $locale == 'ar'){
            $message = $msg['ar'];
            $title = $title['ar'] ;
        }else{
            $message = $msg['en'];
            $title = $title['en'] ;
        }
    
        $fields = array("to" => $key, "notification"=>  array( "text"=>$message ,
        "title"=>$title,
        "type"=>$type,
        "data"=> $msg,
        "is_background"=>false,
        "payload"=>array("my-data-item"=>"my-data-value"),
        "timestamp"=>date('Y-m-d G:i:s'),
        'sound' => 'default', 'badge' =>'1',
        "icon"=>"adam/public/front/images/logo.png",
        "click_action"=>"/adam",
        ), "priority" => "high",
        "data"=>  array( "message"=>$message ,
                        "type"=>$type,
                        "data"=> $msg,
                        "notification_type"=>$title,
                        "title"=>$title,
                        "is_background"=>false,
                        "payload"=>array("my-data-item"=>"my-data-value"),
                        "timestamp"=>date('Y-m-d G:i:s')
                        )
        );
        
    
       $payload =json_encode($fields);

       $curl_session =curl_init();

       curl_setopt($curl_session,CURLOPT_URL, $path_to_fcm);

       curl_setopt($curl_session,CURLOPT_POST, true);

       curl_setopt($curl_session,CURLOPT_HTTPHEADER, $headers);

       curl_setopt($curl_session,CURLOPT_RETURNTRANSFER,true);

       curl_setopt($curl_session,CURLOPT_SSL_VERIFYPEER, false);

       curl_setopt($curl_session,CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE);

       curl_setopt($curl_session,CURLOPT_POSTFIELDS, $payload);

       $result=curl_exec($curl_session);

       curl_close($curl_session);

              dd($result) ;
    }
    
  
    /**
     * Handle language for multilanguages table.
     * 
     * @param  string $returned which returned data 
     * @return [type]           [description]
     */
    public function multiLang($returned='languages')
    {
        $languages = Language::active()->get();
        if ($returned == 'languages') {
            return $languages;
        } elseif ($returned == 'activeLang') {
            return $languages[0]->locale;
        } elseif ($returned == 'moreLang') {
            return count($languages) > 1 ? true : false;
        }
    }
   
    /**
     * Query in multi-languages table.
     * 
     * @param  string $table_1          table_1 name
     * @param  string $table_id         table_1 id
     * @param  string $table_1_position table_1 position
     * @param  string $table_2          table_2m name
     * @param  string $per_page         number of records per page
     * @return collection of recored with translations
     */
    public function multiLangQuery($table_1, $table_id,$table_1_position, $table_2, $per_page=null)
    {
        $query = DB::table($table_1)->join( $table_2,  $table_1. '.' .$table_id, '=',  $table_2. '.' .$table_id)
                ->join('languages',  'languages.languages_code', '=', $table_2.'.languages_code')
                ->orderBy($table_1. '.' .$table_1_position)
                ->orderBy('languages.languages_position');

        $DB = $this->perPage($query, $per_page);

        return $DB;
    }

    /**
     * search in multi-languages table.
     * 
     * @param  string $table_1          table_1 name
     * @param  string $table_id         table_1 id
     * @param  string $table_1_position table_1 position
     * @param  string $table_2          table_2m name
     * @return collection of recored with translations
     */
    public function multiLangQuerySearch($table_1, $table_id,$table_1_position, $table_2)
    {
        $DB = DB::table($table_1)->join( $table_2,  $table_1. '.' .$table_id, '=',  $table_2. '.' .$table_id)
                ->join('languages',  'languages.languages_code', '=', $table_2.'.languages_code')
                ->orderBy($table_1. '.' .$table_1_position)
                ->orderBy('languages.languages_position');

        return $DB;
    }
    /**
     * Search in tables for index page
     * @param  object $query table's query
     * @param  array  $arr   search roles
     * @return query after search
     */
    public function searchIndex($query, array $arr)
    {
        foreach ($arr as $key => $value) {
                
            if (!empty($value[0]) || $value[0] == '0') {
                if ($value[1] == 'like') {
                    $query->where($key, $value[1], '%'. trim($value[0]) . '%');
                } elseif ($value[1] == 'date') {
                    $query->whereDate($key, '=', $value[0]);
                } elseif ($value[1] == 'between') {
                    if (!empty($value[0][0]) && !empty($value[0][1])) {
                        $query->whereBetween($key, [$value[0][0], $value[0][1]]);
                    }
                } elseif ($value[1] == 'in') {
                    $query->whereIn($key, $value[0]);
                } else {
                    $query->where($key, $value[1], $value[0]);
                }
            }
        }

        return $query;
    }

    /**
     * make slug for all languages
     */
    public function makeSlug($string = null, $separator = "-") {
        if (is_null($string)) {
            return "";
        }

        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Lower case everything 
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");;

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }

    ////////////////////////////
    // function get count products in cart for client  
    // /////////////////////////////////////////
    
 
    
    /**
     * Check if Slugs exist and it's
    */
    private function checkSlug($slugs_title, $slugs_key)
    {
        $currentLanguage = app()->getLocale();

        return Slug::join('slug_translations', 'slugs.slugs_id', 'slug_translations.slugs_id')
                ->where('slugs.slugs_key', $slugs_key)
                ->where('slug_translations.slugs_title', $slugs_title)
                ->where('slug_translations.languages_code', $currentLanguage)->first();
    }

    public function switchLanguage()
    {
        $locale = app()->getLocale();
        $route = str_replace(env('REDIRECT').'/'.$locale, $locale == 'en' ? env('REDIRECT').'/ar' : env('REDIRECT').'/en', \URL::full());
        $route = preg_replace('/\W\w+\s*(\W*)$/', '$1', $route);
        // dd($route);
        return redirect($route);
    }


    /**
    *   Switch between languages
    */
    public function lang(Request $request, $lang)
    {
        // dd($lang);
        // Get all Url
        $previous_url = url()->previous();
        // Remove DOmain from URL, just route path
        $previous_url = str_replace($request->root(), '', $previous_url);

        // Transform it into a correct request instance
        $previous_request = app('request')->create($previous_url);

        // Get Query Parameters if applicable
        $query = $previous_request->query();

        // In case the route name was translated
        $route_name = app('router')->getRoutes()->match($previous_request)->getName();
        // return $route_name ;

        // Store the segments of the last request as an array
        $segments = $previous_request->segments();
        // dd($previous_request) ;
        // Check if the first segment matches a language code
        if (in_array($lang, config('translatable.locales'))) {
            
            // If it was indeed a translated route name
            if ($route_name && \Lang::has('routes.' . $route_name, $lang)) {
 
                // Translate the route name to get the correct URI in the required language, and redirect to that URL.
                if (count($query)) {

                    return redirect()->to($lang . '/' .  \Lang::get('routes.' . $route_name, [], $lang) . '?' . http_build_query($query));
                }

                // Redirect with translate [ one level ]
                // if(count($segments) == 2)
                // {
                //     return redirect()->to($lang . '/' .  \Lang::get('routes.' . $route_name, [], $lang));
                // }
               if (count($segments) >= 2) {

                    // Get Opposite langugae
                    $tempLang = $lang == 'ar' ? 'en' : 'ar';

                    // Get first parameter and translate it
                    $firstLevel = \Lang::get('routes.' . $route_name, [], $lang);

                    // Get Key for the given value from lang/routes for previouse language
                    /**
                     * en:-  'project_name'     =>  'Project Name'   ==> then we will get 'project_name'
                     * ar:-  'project_name'     =>  'اسم المشروع'   ==> then we will get 'project_name'
                     */
                     $redirectURL = '' ;
                    // $keySlug = array_search($segments[2], \Lang::get('routes', [], $tempLang));
                    $i = 1 ;
                    // dd(current($segments)) ;
                    $lastIndex = count($segments) - 1 ;
                    $keySlug = array_search($segments[$lastIndex], \Lang::get('routes', [], $tempLang));
                    $secondLevel = \Lang::get('routes.' . $keySlug, [], $lang);
                    $segments[$lastIndex] = $secondLevel ;
                    $segments[0] = $lang ; 
                    $redirectURL  = implode("/", $segments);
                    // dd($redirectURL) ;
                    // foreach ($segments as $segment ) {
                    //     if(count($segments) == $i){
                    //         $keySlug = array_search($segments[$i-1], \Lang::get('routes', [], $tempLang));
                    //         $secondLevel = \Lang::get('routes.' . $keySlug, [], $lang);
                    //         $redirectURL .=$secondLevel;
                    //     }
                    //     elseif($i == 1){
                    //          $redirectURL .= $lang.'/' ;
                    //     }else{
                    //         $redirectURL .=$segment.'/' ;
                    //     }
                    //     $i++;
                    // }
                     // Get Value of this Key from target/given language
                    // $secondLevel = \Lang::get('routes.' . $keySlug, [], $lang);
                    // $redirectURL = ltrim($segments[1] . '/' . $secondLevel);
                     // return $redirectURL ;

                    // redirect
                    // return redirect()->to($lang . '/' .  $redirectURL);
                    return redirect()->to($redirectURL);
                }
 

            }
            // Replace the first segment by the new language code
            $segments[0] = $lang;

            // Redirect to the required URL
            if (count($query)) {
                return redirect()->to(implode('/', $segments) . '?' . http_build_query($query));
            }

            return redirect()->to(implode('/', $segments));
        }

        return redirect()->back();
    }
     
}
