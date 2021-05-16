<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\Sportclub;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function show($club_id)
    {
        return Sportclub::find($club_id)->groups;

        //$group = Group::where(['name', '=', $group_name]);
//        $group = Group::where([
//            ['name', '=', $group_name]
//        ])->withCount('registrations')
//            ->firstOrFail();

        //return new GroupResource($group);
    }

    public function index()
    {
        return GroupResource::collection(Group::all());
    }

    public function store(Request $request)
    {
        $group = $this->ValidateGroup(new Group(), $request);

        return new GroupResource($group);
    }

    public function update(Request $request, $group_name)
    {
        $group = Group::where([
            ['name', '=', $group_name]
        ])->firstOrFail();

        $group = $this->ValidateGroup($group, $request);

        return new GroupResource($group);
    }

    private function ValidateGroup(Group $group, Request $request)
    {
        $data = $request->validate([
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

        return $group;
    }
}
