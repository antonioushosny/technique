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
    
   
     
}
