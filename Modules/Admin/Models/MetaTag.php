<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class MetaTag extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'metatags';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'metatags_id';

    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'metatags_title', 'metatags_desc'
    ];

    /**
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'metatags_created_at';
    const UPDATED_AT = 'metatags_updated_at';

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
       'metatags_page', 'metatags_position'
    ];

    /**
     * Get the service that owns the metatag.
     */
    public function service()
    {
        return $this->belongsTo('Modules\Admin\Models\Service', 'metatags_id', 'metatags_id');
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
        return $query->orderBy('metatags_position', $type)->orderBy('metatags.metatags_id', $type);
    }

    
}
