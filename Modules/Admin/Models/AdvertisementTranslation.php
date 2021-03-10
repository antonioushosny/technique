<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class AdvertisementTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    
    protected $table = 'advertisement_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'advertisements_trans_id';

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
        'advertisements_text','advertisements_img','advertisements_mobile_img'
    ];

    /**
     * Set services's image.
     * 
     * @param string $file
     */
    public function setAdvertisementsImgAttribute($file)
    {
        
        if ($file) {
            if (is_string($file)) {
                $this->attributes['advertisements_img'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name);
                $this->mediumImage($file, $current_name,null,400); 
                $this->thumbImage($file, $current_name,100,null);

                $this->attributes['advertisements_img'] = $current_name;
            }
        } else {
            $this->attributes['advertisements_img'] = null;
        }
    }

    public function setAdvertisementsMobileImgAttribute($file)
    {
        
        if ($file) {
            if (is_string($file)) {
                $this->attributes['advertisements_mobile_img'] = $file;
            } else {
                 $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name);
                $this->mediumImage($file, $current_name,null,200);
                $this->thumbImage($file, $current_name,100,null);

                $this->attributes['advertisements_mobile_img'] = $current_name;
                
            }
        } else {
            $this->attributes['advertisements_mobile_img'] = null;
        }
    }

    /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function advertisement()
    {
    	return $this->belongsTo('Modules\Admin\Models\Advertisement', 'advertisements_id', 'advertisements_id');
    }
}
