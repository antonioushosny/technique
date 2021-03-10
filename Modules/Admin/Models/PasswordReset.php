<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
 
class PasswordReset extends Model
{
    protected $connection = 'mysql';
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * Primary key.
     * 
     * @var string
     */
 
  
 
    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'email', 'token'
    ];

    
}
