<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UniversalTable extends Model
{
    use HasFactory;
    protected $table = 'universaltables';
    protected $fillable = [
        'client_name','user_id','phone', 'pan','created_at','updated_at'
    ];

    // public function __construct(array $attributes = array())
    // {
    //     parent::__construct($attributes);

    //     // Set the database connection name.
    //     $this->setConnection(configureConnectionByName(getTenantName(Auth::user()->tenant_id)));
    // }
}
