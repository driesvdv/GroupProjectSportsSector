<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use App\Models\SportSession;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportSessionController extends Controller
{
    public function show($session_id){
        try {
            $sport_session = Registrant::where([
                ['id', '=', $session_id]
            ])->first();

            return response()->json([$sport_session], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request){
        try {
            $sport_session = new SportSession();

            $data = request()->validate([
                'start_time' => 'required',
                'end_time' => 'required',
                'group_id' => 'required'
            ]);

            $sport_session->start_time = $data['start_time'];
            $sport_session->end_time = $data['end_time'];
            $sport_session->group_id = $data['group_id'];

            $sport_session->save();

            return response()->json([$sport_session], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $session_id){
        try {
            $sport_session = SportSession::where([
                ['id', '=', $session_id]
            ])->first();

            $data = request()->validate([
                'start_time' => 'required',
                'end_time' => 'required',
                'group_id' => 'required'
            ]);

            $sport_session->start_time = $data['start_time'];
            $sport_session->end_time = $data['end_time'];
            $sport_session->group_id = $data['group_id'];

            $sport_session->save();

            return response()->json([$sport_session], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
