<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceGroupMap;
use App\Http\Requests;

class ServiceGroupMapController extends Controller
{
    public function index() {
        $result = ServiceGroupMap::all()->groupBy('service_group_id');
        $data = [
            'status' => 1,
            'message' => "created", 
            'data' => $result
        ];

        return response()->json($data);
    }
    

    public function store(Request $request) {
        $data = [
            'status' => 1,
            'message' => null,
            'data' => null
        ];
        if(isset($request->service_id) && isset($request->service_group_id)){
            $arr = $request->only(['service_id','service_group_id']);       
            $data['data'] = ServiceGroupMap::create($arr);
            $data['message'] = "created";
        }

        return response()->json($data);
    }

    public function show() {

    }

    public function update() {
       
    }

    public function destroy($group_service_map_id) {
        $service_group_map = ServiceGroupMap::where('group_service_map_id',$group_service_map_id)->first();
        $service_group_map->delete();       
        $data = [
            'status' => 1 ,
            'message' => "deleted",
            'data'=>""
        ];
        return response()->json($data);
    }

    
}
