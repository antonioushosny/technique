<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class Geo extends Model
{
    use StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'geos';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

     

    /**
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'country','city','region'
    ];

   

}
