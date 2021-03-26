<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sportclub;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportclubController extends Controller
{
    public function show($sportclub_name){
        try {
            return Sportclub::where('name', $sportclub_name)->first();
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function index(){
        try {
            return Sportclub::all();
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function update(Request $request, $sportclub_name){
        try {
            $user = Auth::user();
            $sportclub = Sportclub::where('name', $sportclub_name)->first();

            if (!$this->isAdmin($sportclub, $user)){
                return response()->json(['message' => 'Permission denied'], 403);
            }

            $data = request()->validate([
                'name' => 'required',
                'sport_id' => 'required'
            ]);

            $sportclub->name = $data['name'];
            $sportclub->sport_id = $data['sport_id'];

            $sportclub->save();
            return response()->json($sportclub, 403);

        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    //helpers
    private function isAdmin($sportclub, $user){
        return true;
    }
}
