<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTagTranslation extends Model
{
    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'metatag_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'metatags_trans_id';

    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'metatags_title', 'metatags_desc'
    ];


    /**
     * Set MetaTags title.
     * 
     * @param string $value
     */
    public function setMetatagsTitleAttribute($value)
    {
        if ($value) {
            // $this->attributes['metatags_title'] = $this->makeSlug($value);
            $this->attributes['metatags_title'] = $value;
        }
    }

    /**
     * Many to one relation with metatags.
     * 
     * @return collection of metatag
     */
    public function metatag()
    {
    	return $this->belongsTo('Modules\Admin\Models\MetaTag', 'metatags_id', 'metatags_id');
    }




    /**
     * make slug for all languages
     */
    private function makeSlug($string = null, $separator = "-") {
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
        # $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);
        $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);
  

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }
}
