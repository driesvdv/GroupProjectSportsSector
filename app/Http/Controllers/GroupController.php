<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function show($group_name){
        try {
            $group = Group::where([
                ['name', '=', $group_name]
            ])->first();

            return response()->json([$group], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function index(){
        try {
            $groups = Registrant::all();

            return response()->json([$groups], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function store(Request $request){
        try {
            $group = new Group();

            $data = request()->validate([
                'name' => 'required',
                'time' => 'required',
                'max_members' => 'required',
                'sportclub_id' => 'required'
            ]);

            $group->name = $data['name'];
            $group->time = $data['time'];
            $group->max_members = $data['max_members'];
            $group->sportclub_id = $data['sportclub_id'];

            $group->save();

            return response()->json([$group], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $group_name){
        try {
            $group = Group::where([
                ['name', '=', $group_name]
            ])->first();

            $data = request()->validate([
                'name' => 'required',
                'time' => 'required',
                'max_members' => 'required',
                'sportclub_id' => 'required'
            ]);

            $group->name = $data['name'];
            $group->time = $data['time'];
            $group->max_members = $data['max_members'];
            $group->sportclub_id = $data['sportclub_id'];

            $group->save();

            return response()->json([$group], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
