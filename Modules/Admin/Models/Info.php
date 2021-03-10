<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Info extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'infos';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'infos_id';

    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'infos_title', 'infos_desc'
    ];

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
        'infos_key', 'infos_status', 'infos_position'
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
        return $query->orderBy('infos_position', $type)->orderBy('infos.infos_id', $type);
    }
}
