<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'service_id',
        'service_name'
    ];
    protected $primaryKey = 'service_id';
    public function service_groups(){
        return $this->belongsToMany('App\ServiceGroup','service_group_map','service_id','service_group_id');
    }
}
