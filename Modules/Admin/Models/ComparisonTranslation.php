<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StorageHandle;

class ComparisonTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    
    protected $table = 'comparison_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'comparisons_trans_id';

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
        'comparisons_title' 
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
}
