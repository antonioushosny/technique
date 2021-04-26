<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Phone extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;
    protected $table = 'phones';
    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'phones_id';


    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'phones_title'
    ];

    /**
     * 
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'phones_created_at';
    const UPDATED_AT = 'phones_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phones_image', 'phones_status'
    ];
 /**
     * Set services's image.
     * 
     * @param string $file
     */
    public function setPhonesImageAttribute($file)
    {
        
        if ($file) {
            if (is_string($file)) {
                $this->attributes['phones_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name);
                $this->mediumImage($file, $current_name,null,400); 
                $this->thumbImage($file, $current_name,100,null);

                $this->attributes['phones_image'] = $current_name;
            }
        } else {
            $this->attributes['phones_image'] = null;
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
        // return $query->orderBy('phones_position', $type)->orderBy('phones.phones_id', $type);
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
        return $query->where('phones_status', 'active');
    }

     

}
