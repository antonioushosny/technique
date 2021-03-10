<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $connection = 'mysql';
    /**
     * 
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'contact_us_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_us_name','contact_us_phone','contact_us_email', 'contact_us_type', 'contact_us_message'
    ];

    /**
     * Timestamps.
     * 
     * @var string
     */
    const CREATED_AT = 'contact_us_created_at';
    const UPDATED_AT = 'contact_us_updated_at';


}
