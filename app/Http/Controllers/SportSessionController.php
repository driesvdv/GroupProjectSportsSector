<?php

namespace App\Http\Controllers;

use App\Http\Resources\SportSessionResource;
use App\Models\AbsentSession;
use App\Models\Group;
use App\Models\SportSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportSessionController extends Controller
{
    public function show($session_id, $registration_id = 61)
    {
        $sessions = Group::find($session_id)
            ->sportSessions()
            ->limit(6)
            ->get();

        return new SportSessionResource($sessions);
    }

    public function isAbsent($session_id, Request $request)
    {
        return AbsentSession::where('registration_id', $request->registration_id)
            ->where('sport_session_id', $session_id)
            ->get()->isempty() ? "false" : "true";
    }

    public function store(Request $request)
    {
        $sport_session = $this->ValidateSportSession($request, new SportSession());

        return new SportSessionResource($sport_session);
    }

    public function update(Request $request, $session_id)
    {
        $sport_session = SportSession::where([
            ['id', '=', $session_id]
        ])->firstOrFail();

        $sport_session = $this->ValidateSportSession($request, $sport_session);

        return new SportSessionResource($sport_session);
    }

    private function ValidateSportSession(Request $request, SportSession $sport_session)
    {
        $data = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'group_id' => 'required'
        ]);

        $sport_session->start_time = $data['start_time'];
        $sport_session->end_time = $data['end_time'];
        $sport_session->group_id = $data['group_id'];

        $sport_session->save();

        return $sport_session;
    }
}
