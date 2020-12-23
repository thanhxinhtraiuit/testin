<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;

class ServiceGroup extends Model
{
    protected $table = 'service_group';

    protected $fillable = [
        'service_group_id',
        'service_group_name',
        'service_group_parent'
    ];

    protected $primaryKey = 'service_group_id';

    public function services(){
        return $this->belongsToMany('App\Service','service_group_map','service_id','service_group_id');
    }
    public function getServiceByServiceGroupId($service_group_id){
        $services = $this->select('services.service_id','services.service_name')
                    ->join('service_group_map','service_group_map.service_group_id','=','service_group.service_group_id')
                    ->join('services','services.service_id','=','service_group_map.service_id')
                    ->where('service_group.service_group_id',$service_group_id)
                    ->get();

        return $services;
    }

    public function getServiceGroupIDChil($service_group_id){
        $result = $this->select('service_group_id')->where('service_group_parent',$service_group_id)->get();
        if(empty($result)) return [];
        return $result;
    }

    public function getAllServiceGroupId($service_group_id){
        if(empty($service_group_id)) return;
        $arrSGI = $this->getServiceGroupIDChil($service_group_id);
        
        if(empty($arrSGI)){
            return $arrSGI;
        } 
        foreach ($arrSGI as $key => $value) {
            // $arrSGI[]=$this->getAllServiceGroupId($value->service_group_id);
            // return $arrSGI;
            return $arrSGI->merge($this->getAllServiceGroupId($value->service_group_id));

        }
        return $arrSGI;
    }

    public function getAllService(){
        $service_group_id = $this->service_group_id;
        $arrServiceGroupId = $this->getAllServiceGroupId($service_group_id);
        $services = $this->getServiceByServiceGroupId($service_group_id);
        $data =$services->toArray();
        foreach ($arrServiceGroupId as $key => $value) {
            $data = array_merge($data,$this->getServiceByServiceGroupId($value->service_group_id)->toArray());   
        }

        return array_unique($data,SORT_REGULAR);
    }

    public function getById($id){
        return $this->where('service_group_id',$id)->first();
    }
}

