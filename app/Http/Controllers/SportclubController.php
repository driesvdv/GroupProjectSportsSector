<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sportclub;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportclubController extends Controller
{
    public function index($sportclub_name){
        try {
            return Sportclub::where('name', $sportclub_name)->first();
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function update(Request $request, $sportclub_name){
        try {
            $user = Auth::user();
            $sportclub = Sportclub::where('name', $sportclub_name)->first();

            if ($this->isAdmin($sportclub, $user)){
                $sportclub = $request->all();
                return $sportclub;
            }
            return response()->json(['message' => 'Permission denied'], 403);

        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    //helpers
    private function isAdmin($sportclub, $user){
        return true;
    }
}
