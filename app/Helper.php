<?php 

use Modules\Admin\Models\Setting;
use Modules\Admin\Models\Info;
use Modules\Admin\Models\Service;
use Modules\Admin\Models\MetaTag;
use Modules\Admin\Models\Slug;
use Modules\Admin\Models\SlugTranslation;
 /**
 * Get static Setting by it's key
 */
function getSettingByKey($key)
{
    return Setting::where('settings_key', $key)->value('settings_value');
}
 

/**
 * Get static Info by it's key
 */
function getInfoByKey($key)
{
    // return Info::where('info_key', $key)->value('info_value');
    $infos = Info::join('info_translations', 'infos.infos_id', 'info_translations.infos_id')
        ->where('infos.infos_key', $key)
        ->first();

    return $infos;
}

/**
 * Get MetaTag by Page key
 */
function getMetaByKey($key)
{

    $meta = MetaTag::where('metatags_page', $key)
        ->first();

    return $meta;
}

/**
 * Make Slug for title
 */
function make_slug($string = null, $separator = "-") {
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
     $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);
  
    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);
    return $string;
}


/**
 * custom functio to return slug from table
 */
 function getSlugByKey($slugs_key)
{
    $currentLanguage = app()->getLocale();

    $slug = Slug::join('slug_translations', 'slugs.slugs_id', 'slug_translations.slugs_id')
                        ->where('slugs.slugs_key', $slugs_key)
                        ->where('slug_translations.languages_code', $currentLanguage)->first();
    return $slug->slugs_title;
}

/**
 * custom functio to return slug based on Language
 */
function getSlugByKeyWithLang($slugs_key, $lang)
{

    $slug = DB::table('slugs')->join('slug_translations', 'slugs.slugs_id', 'slug_translations.slugs_id')
                        ->where('slugs.slugs_key', $slugs_key)
                        ->where('slug_translations.languages_code', $lang)->first();
    // dd($slugs_key);
    
    return $slug->slugs_title;
}


function seo($string) {
    
    $string = trim($string);

    $string = preg_replace('#[^\w]#', ' ', $string);
    
    $string = preg_replace('#[\s]+#', ' ', $string);
    
    $string = str_replace(' ', '-', $string);
    
    return trim(strtolower($string), '-');
}

?>
