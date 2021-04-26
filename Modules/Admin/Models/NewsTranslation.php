<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class NewsTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    
    protected $table = 'news_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'news_trans_id';

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
        'news_title' ,'news_desc'
    ];

   
    /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function news()
    {
    	return $this->belongsTo('Modules\Admin\Models\News', 'news_id', 'news_id');
    }
}
