<?php

namespace App\Http\Controllers;

use App\Events\RegistrationAdded;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistrationResource;
use App\Models\Registrant;
use App\Models\Registration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class RegistrationController extends Controller
{
    /**
     * Returns all registrations
     *
     * @param $registrant_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($registrant_id)
    {
        $registrations = Registration::where([
            ['registrant_id', '=', $registrant_id]
        ])->get();

        return RegistrationResource::collection($registrations);
    }

    public function show($registrant_id, $group_id){
        $registration = Registration::where([
            ['group_id', '=', $group_id],
            ['registrant_id', '=', $registrant_id]
        ])->firstOrFail();

        return new RegistrationResource($registration);
    }

    /**
     * Stores the registration
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        if ($this->hasRegistration($request)) return response()->json(['message'=> 'Lid is al ingeschreven in deze groep!'], 400);

        $registration = $this->ValidateRegistration($request, new Registration());

        Broadcast(new RegistrationAdded($registration))->toOthers();

        return new RegistrationResource($registration);
    }

    public function update(Request $request, $registrant_id, $registration_id){
        $registration = Registration::where([
            ['id', '=', $registration_id],
            ['registrant_id', '=', $registrant_id]
        ])->firstOrFail();

        $registration = $this->ValidateRegistration($request, $registration);

        return new RegistrationResource($registration);
    }

    private function ValidateRegistration(Request $request, Registration $registration)
    {
        $data = $request->validate([
            'group_id' => 'required',
            'registrant_id' => 'required',
        ]);

        $registration->group_id = $data['group_id'];
        $registration->registrant_id = $data['registrant_id'];

        $registration->save();

        return $registration;
    }

    private function hasRegistration(Request $request){
        return Registration::where([
            ['group_id', '=', $request->input('group_id')],
            ['registrant_id', '=', $request->input('registrant_id')]
        ])->first();
    }
}
