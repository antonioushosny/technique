<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class PhoneTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    
    protected $table = 'phone_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'phones_trans_id';

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
        'phones_title' 
    ];

   
    /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function phone()
    {
    	return $this->belongsTo('Modules\Admin\Models\Phone', 'phones_id', 'phones_id');
    }
}
