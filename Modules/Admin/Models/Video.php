<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Video extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;

    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'videos_id';


    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'videos_title'
    ];

    /**
     * 
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'videos_created_at';
    const UPDATED_AT = 'videos_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videos_url', 'videos_status'
    ];
 
    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type='asc')
    {
        // return $query->orderBy('videos_position', $type)->orderBy('videos.videos_id', $type);
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
        return $query->where('videos_status', 'active');
    }

     

}
