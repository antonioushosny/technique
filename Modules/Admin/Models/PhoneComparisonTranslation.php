<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class PhoneComparisonTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    
    protected $table = 'phone_comparison_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'phones_comparisons_trans_id';

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
        'phones_comparisons_text','locale'
    ];

   
    /**
     * Many to one relation with branches.
     * 
     * @return collection of branch
     */
    public function phones_comparison()
    {
    	return $this->belongsTo('Modules\Admin\Models\PhoneComparison', 'phones_comparisons_id', 'phones_comparisons_id');
    }
}
