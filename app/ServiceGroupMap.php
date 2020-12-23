<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGroupMap extends Model
{
    protected $table = 'service_group_map';

    protected $fillable = [
        'service_group_map_id',
        'service_id',
        'service_group_id'
    ];

    // public function service_name(){
    //     return $this->hashOne('App\Service','service_id');
    // }
}
