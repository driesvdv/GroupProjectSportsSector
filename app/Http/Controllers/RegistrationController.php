<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use App\Models\Registration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index($registrant_id, $registration_id){
        try {
            $registration = Registration::where([
                ['id', '=', $registration_id],
                ['registrant_id', '=', $registrant_id]
            ])->first();

            return response()->json([$registration], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request, $registrant_id){
        try {
            $registration = new Registration();

            $data = request()->validate([
                'group_id' => 'required',
                'registrant_id' => 'required',
                'has_paid' => 'required',
            ]);

            $registration->group_id = $data['group_id'];
            $registration->registrant_id = $data['registrant_id'];
            $registration->has_paid = $data['has_paid'];

            $registration->save();
            return response()->json([$registration], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update($registrant_id){
        try {
            $registration = Registrant::where([
                ['id', '=', $registrant_id],
                ['registran_id', '=', $registrant_id]
            ])->first();

            $data = request()->validate([
                'group_id' => 'required',
                'registrant_id' => 'required',
                'has_paid' => 'required',
            ]);

            $registration->group_id = $data['group_id'];
            $registration->registrant_id = $data['registrant_id'];
            $registration->has_paid = $data['has_paid'];

            $registration->save();
            return response()->json([$registration], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
