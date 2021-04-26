<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class News extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;
    protected $table = 'news';
    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'news_id';


    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'news_title','news_desc'
    ];

    /**
     * 
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'news_created_at';
    const UPDATED_AT = 'news_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_image', 'news_status'
    ];
 /**
     * Set services's image.
     * 
     * @param string $file
     */
    public function setNewsImageAttribute($file)
    {
        
        if ($file) {
            if (is_string($file)) {
                $this->attributes['news_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name);
                $this->mediumImage($file, $current_name,null,400); 
                $this->thumbImage($file, $current_name,100,null);

                $this->attributes['news_image'] = $current_name;
            }
        } else {
            $this->attributes['news_image'] = null;
        }
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
        // return $query->orderBy('news_position', $type)->orderBy('news.news_id', $type);
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
        return $query->where('news_status', 'active');
    }

     

}
