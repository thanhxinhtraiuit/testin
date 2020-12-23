<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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

        $arr = [];
        if(isset($request->group_name)) {
            $arr['group_name'] = $request->group_name;
        }

        if(isset($request->group_id_parent)) {
            $arr['group_id_parent'] = $request->group_id_parent;
        }
        $serviceGroup ="";
        if(!empty($arr)) {
            $serviceGroup = ServiceGroup::create($arr);
        }
        $data = [
            'status' => 1,
            'message' => "created", 
            'data' => $serviceGroup
        ];

        return response()->json($data);
    }
    public function show(Request $request,$group_service_id){  
        $service_group = ServiceGroup::where('service_group_id',$group_service_id)->first();
        $service_group['services'] = $service_group->getAllService();
        $data = [
            'status' => 1 ,
            'message' => "ok",
            'data'=>$service_group
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
