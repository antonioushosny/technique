<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Advertisement extends Model
{
    use  StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;

    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'advertisements_id';

 

    /**
     * 
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'advertisements_created_at';
    const UPDATED_AT = 'advertisements_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advertisements_name','advertisements_url', 'advertisements_status','shops_id','advertisements_color', 'advertisements_img','advertisements_mobile_img'
    ];

    /**
     * Set advertisement image
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

      /**
     * Set advertisement image
     * 
     * @param string $file
     */
    public function setAdvertisementsMobileImgAttribute($file)
    {
        
        if ($file) {
            if (is_string($file)) {
                $this->attributes['advertisements_mobile_img'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name);
                $this->mediumImage($file, $current_name,null,400); 
                $this->thumbImage($file, $current_name,100,null);

                $this->attributes['advertisements_mobile_img'] = $current_name;
            }
        } else {
            $this->attributes['advertisements_mobile_img'] = null;
        }
    }

     /**
     * Many to one relation with shop.
     * 
     * @return collection of city
     */
     public function shop()
    {
        return $this->belongsTo('Modules\Ecommerce\Models\Shop', 'shops_id', 'shops_id');
    }


    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type='asc')
    {
        // return $query->orderBy('advertisements_position', $type)->orderBy('advertisements.advertisements_id', $type);
    }

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('advertisements_status', '1');
    }

    public function scopeBanner($query)
    {
        return $query->where('advertisements_view_page', 'home_banner');
    }

    public function scopeStores($query)
    {
        return $query->where('advertisements_view_page', 'home_stores');
    }

    public function scopeOffers($query)
    {
        return $query->where('advertisements_view_page', 'home_offers');
    }

    public function scopeProducts($query)
    {
        return $query->where('advertisements_view_page', 'all_products_filter');
    }

}
