<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index($registrant_id){
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

    public function store(Request $request, $registrant_id){
        try {
            $user = Auth::user();
            $registrant = new Registrant();

            $data = request()->validate([
                'group_id' => 'required',
                'registrant_id' => 'required',
                'has_paid' => 'required',
            ]);

            $registrant->group_id = $data['group_id'];
            $registrant->registrant_id = $data['registrant_id'];
            $registrant->has_paid = $data['has_paid'];

            return response()->json([$registrant], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update($registrant_id){
        try {
            $user = Auth::user();
            $registrant = Registrant::where([
                ['id', '=', $registrant_id],
                ['user_id', '=', $user->id]
            ])->first();

            $data = request()->validate([
                'group_id' => 'required',
                'registrant_id' => 'required',
                'has_paid' => 'required',
            ]);

            $registrant->group_id = $data['group_id'];
            $registrant->registrant_id = $data['registrant_id'];
            $registrant->has_paid = $data['has_paid'];

            return response()->json([$registrant], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
