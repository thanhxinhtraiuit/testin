<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;
use App\ServiceGroup;

class ServiceGroupController extends Controller
{
    public function index(){
        $results = ServiceGroup::all();

        $data = [
            'status' => 1,
            'message' => "created", 
            'data' => $results
        ];

        return response()->json($data);
    }
    public function store(Request $request){
        $request->validate([
            'group_name' => 'required|string'
        ]);
        $arr['group_name'] = $request->group_name;
        if(isset($request->group_id_parent)) {
            $arr['group_id_parent'] = $request->group_id_parent;
        }
        $serviceGroup = ServiceGroup::create($arr);
        $data = [
            'status' => 1,
            'message' => "created", 
            'data' => $serviceGroup
        ];

        return response()->json($data);
    }
    public function show($group_service_id){  
        $service_group = ServiceGroup::where('service_group_id',$group_service_id)->first();
        $temp = $service_group->getAllServiceGroupIdV2($group_service_id)->sortBy('group_service_id');

        // usort($temp, function($a, $b) {
        //     return $a['group_service_id'] - $b['group_service_id'];
        // });
        $service_group['service_group'] = $temp;
        $services = $service_group->getAllService();
        usort($services, function($a, $b) {
            return $a['service_id'] - $b['service_id'];
        });
        $service_group['services'] = $services;
        $data = [
            'status' => 1 ,
            'message' => "ok",
            'data'=>$temp
        ];
        return response()->json($data);
    }
    public function destroy($group_service_id){
        $service_group = ServiceGroup::where('service_group_id',$group_service_id)->first();
        $service_group->delete();       
        $data = [
            'status' => 1 ,
            'message' => "deleted",
            'data'=>""
        ];
        return response()->json($data);
    }
    public function update(Request $request, $group_service_id){       
        $service_group = ServiceGroup::where('service_group_id',$group_service_id)->first();
        $service_group->update($request->only(['service_group_name','service_group_parent']));
        $data = [
            'status' => 1 ,
            'message' => "updated",
            'data'=>$service_group
        ];
        return response()->json($data);
    }

}
