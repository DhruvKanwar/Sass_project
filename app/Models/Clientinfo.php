<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clientinfo extends Model
{
    use HasFactory;
    protected $table = 'clientinfos';
    protected $fillable = [
        'name', 'email','user_id', 'client_db_name','created_at','updated_at'
    ];

    // public function __construct(array $attributes = array())
    // {
    //     parent::__construct($attributes);

    //     // Set the database connection name.
    //     $this->setConnection(configureConnectionByName(getTenantName(Auth::user()->tenant_id)));
    // }
}
