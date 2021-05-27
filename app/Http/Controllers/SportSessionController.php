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
    /**
     * Returns the last 10 sessions
     *
     * @param int $group_id The group id
     * @return \App\Http\Resources\SportSessionResource
     */
    public function show(int $group_id): SportSessionResource
    {
        $sessions = Group::find($group_id)
            ->sportSessions()
            ->orderby('start_time', 'desc')
            ->limit(6)
            ->get();

        return new SportSessionResource($sessions);
    }

    public function isAbsent($session_id, $registration_id, Request $request)
    {
        return AbsentSession::where('registration_id', $registration_id)
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
