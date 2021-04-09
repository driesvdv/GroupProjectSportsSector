<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SportclubResource;
use App\Models\Sportclub;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportclubController extends Controller
{
    public function show($sportclub_name){
        $sportclub = Sportclub::where('name', $sportclub_name)->firstOrFail();

        return new SportclubResource($sportclub);
    }

    public function index(){
        return SportclubResource::collection(Sportclub::all());
    }

    public function update(Request $request, $sportclub_name){
        $sportclub = Sportclub::where('name', $sportclub_name)->firstOrFail();

        if (!$this->isAdmin($sportclub)){
            return response()->json(['message' => 'Permission denied'], 403);
        }

        $sportclub = $this->ValidateSportclub($request, $sportclub);
        return new SportclubResource($sportclub);
    }

    //helpers
    private function isAdmin($sportclub){
        return true;
    }


    private function ValidateSportclub(Request $request, Sportclub $sportclub)
    {
        $data = $request->validate([
            'name' => 'required',
            'sport_id' => 'required'
        ]);

        $sportclub->name = $data['name'];
        $sportclub->sport_id = $data['sport_id'];

        $sportclub->save();

        return $sportclub;
    }
}
