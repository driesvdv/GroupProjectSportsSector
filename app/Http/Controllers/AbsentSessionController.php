<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbsentSessionResource;
use App\Models\AbsentSession;
use App\Models\SportSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsentSessionController extends Controller
{
    public function show($session_id, $absent_id){
        $absent_session = AbsentSession::where([
            ['sport_session_id', '=', $absent_id],
            ['id', '=', $session_id]
        ])->firstOrFail();

        return new AbsentSessionResource($absent_session);

    }

    public function store(Request $request){
        $absent_session = $this->ValidateAbsentSession(new AbsentSession(), $request);

        return new AbsentSessionResource($absent_session);
    }

    public function delete($sport_session_id, $registration_id){
        $absent_session = AbsentSession::where([
            ['registration_id', '=', $registration_id],
            ['sport_session_id', '=', $sport_session_id]
        ])->firstOrFail();

        $absent_session->delete();

        return [
            'status' => 200,
            'message' => 'session deleted'
            ];
    }

    private function ValidateAbsentSession(AbsentSession $absent_session, Request $request)
    {
        $data = $request->validate([
            'sport_session_id' => 'required',
            'registration_id' => 'required'
        ]);

        $absent_session->sport_session_id = $data['sport_session_id'];
        $absent_session->registration_id = $data['registration_id'];

        $absent_session->save();

        return $absent_session;
    }
}
