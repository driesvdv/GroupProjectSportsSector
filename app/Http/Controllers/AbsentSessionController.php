<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AbsentSession;
use App\Models\SportSession;
use Illuminate\Http\Request;

class AbsentSessionController extends Controller
{
    public function show($session_id, $absent_id){
        try {
            $absent_session = AbsentSession::where([
                ['sport_session_id', '=', $absent_id],
                ['id', '=', $session_id]
            ])->first();

            return response()->json([$absent_session], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request){
        try {
            $absent_session = new AbsentSession();

            $data = request()->validate([
                'sport_session_id' => 'required',
                'registration_id' => 'required'
            ]);

            $absent_session->sport_session_id = $data['sport_session_id'];
            $absent_session->registration_id = $data['registration_id'];

            $absent_session->save();

            return response()->json([$absent_session], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $session_id){
        try {
            $absent_session = AbsentSession::where([
                ['id', '=', $session_id]
            ])->first();

            $data = request()->validate([
                'sport_session_id' => 'required',
                'registration_id' => 'required'
            ]);

            $absent_session->sport_session_id = $data['sport_session_id'];
            $absent_session->registration_id = $data['registration_id'];

            $absent_session->save();

            return response()->json([$absent_session], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
