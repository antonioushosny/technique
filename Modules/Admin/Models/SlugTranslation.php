<?php

namespace Modules\Admin\Models;

use App\Models\MasterModel;

use Illuminate\Database\Eloquent\Model;
class SlugTranslation extends Model
{
    protected $connection = 'mysql';
    protected $table = 'slug_translations';
    protected $primaryKey = 'slugs_trans_id'; 
    public $timestamps = false;

    protected $fillable = [
    	'slugs_title',
    ];

    public function slug()
    {
    	return $this->belongsTo('Modules\Admin\Models\Slug', 'slugs_id', 'slugs_id');
    }
}
