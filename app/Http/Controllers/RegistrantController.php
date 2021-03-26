<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrantController extends Controller
{
    public function show($registrant_id){
        try {
            $user = Auth::user();
            $registrant = Registrant::where([
                ['id', '=', $registrant_id],
                ['user_id', '=', $user->id]
            ])->first();

            return response()->json([$registrant], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function index(){
        try {
            $user = Auth::user();
            $registrants = Registrant::where([
                ['user_id', '=', $user->id]
            ])->get();

            return response()->json([$registrants], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request){
        try {
            $registrant = new Registrant();

            $data = request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'birth_date' => 'required',
                'max_registrations' => 'required'
            ]);

            $registrant->first_name = $data['first_name'];
            $registrant->last_name = $data['last_name'];
            $registrant->birth_date = $data['birth_date'];
            $registrant->max_registrations = $data['max_registrations'];

            $registrant->save();

            return response()->json([$registrant], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $registrant_id){
        try {
            $user = Auth::user();
            $registrant = Registrant::where([
                ['id', '=', $registrant_id],
                ['user_id', '=', $user->id]
            ])->first();

            $data = request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'birth_date' => 'required',
                'max_registrations' => 'required'
            ]);

            $registrant->first_name = $data['first_name'];
            $registrant->last_name = $data['last_name'];
            $registrant->birth_date = $data['birth_date'];
            $registrant->max_registrations = $data['max_registrations'];

            $registrant->save();

            return response()->json([$registrant], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
