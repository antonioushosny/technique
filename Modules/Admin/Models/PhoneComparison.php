<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class PhoneComparison extends Model
{
    use \Dimsav\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;
    protected $table = 'phone_comparisons';
    /**
     * Primary key. 
     * 
     * @var string
     */
    protected $primaryKey = 'phones_comparisons_id';


    /**
     * Translated attributes.
     * 
     * @var array
     */
    public $translatedAttributes =  [
        'phones_comparisons_text'
    ];

    /**
     * 
     * Timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comparisons_id', 'phones_id'
    ];
  
     /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function comparison()
    {
    	return $this->belongsTo('Modules\Admin\Models\Comparison', 'comparisons_id', 'comparisons_id');
    }

    /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function phone()
    {
    	return $this->belongsTo('Modules\Admin\Models\Phone', 'phones_id', 'phones_id');
    }

    public function trans()
    {
        return $this->hasMany('Modules\Admin\Models\PhoneComparisonTranslation', 'phones_comparisons_id', 'phones_comparisons_id');
    }

}
