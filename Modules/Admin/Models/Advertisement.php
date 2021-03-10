<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Advertisement extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;

    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'advertisements_id';


    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'advertisements_text', 'advertisements_img','advertisements_mobile_img'
    ];

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
        'advertisements_name','advertisements_url', 'advertisements_status','shops_id','advertisements_color','advertisements_view_page'
    ];



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
