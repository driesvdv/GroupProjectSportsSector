<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegistrationResource;
use App\Models\Registrant;
use App\Models\Registration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function show($registrant_id, $registration_id){
        $registration = Registration::where([
            ['id', '=', $registration_id],
            ['registrant_id', '=', $registrant_id]
        ])->firstOrFail();

        return new RegistrationResource($registration);
    }

    public function index($registrant_id){
        $registrations = Registration::where([
            ['registrant_id', '=', $registrant_id]
        ])->get();

        return RegistrationResource::collection($registrations);
    }


    public function store(Request $request){
        $registration = $this->ValidateRegistration($request, new Registration());

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
            'has_paid' => 'required',
        ]);

        $registration->group_id = $data['group_id'];
        $registration->registrant_id = $data['registrant_id'];
        $registration->has_paid = $data['has_paid'];

        $registration->save();

        return $registration;
    }
}
