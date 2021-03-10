<?php

namespace Modules\Admin\Models;

use App\Models\MasterModel;

use Illuminate\Database\Eloquent\Model;
class Slug extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $connection = 'mysql';
    public $translatedAttributes =  [
    	'slugs_title',
    ];

    protected $table = 'slugs';
    protected $primaryKey = 'slugs_id';
    public $timestamps = false;

    protected $fillable = ['slugs_key'];

    public function slugsTrans()
    {
    	return $this->hasMany('Modules\Admin\Models\SlugTranslation', 'slugs_id', 'slugs_id');
    }
}
