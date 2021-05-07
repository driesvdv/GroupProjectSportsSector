<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Resources\RegistrantResource;
use App\Models\Registrant;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrantController extends Controller
{
    public function show($registrant_id){
        $user = Auth::user();
        $registrant = Registrant::where([
            ['id', '=', $registrant_id],
            ['user_id', '=', $user->id]
        ])->firstOrFail();

        return new RegistrantResource($registrant);
    }

    public function index(){
        $user = Auth::user();
        $registrants = Registrant::where([
            ['user_id', '=', $user->id]
        ])->get();

        return 'test';
    }

    public function store(Request $request)
    {
        return dump($request->user()->registrants);

        return (auth()->user()->registrants);

        return 'test';
    }

    public function update(Request $request, $registrant_id){
        $user = Auth::user();
        $registrant = Registrant::where([
            ['id', '=', $registrant_id],
            ['user_id', '=', $user->id]
        ])->firstOrFail();

        $registrant = $this->ValidateRegistrant($registrant, $request);

        return new RegistrantResource($registrant);
    }

    private function ValidateRegistrant(Registrant $registrant, Request $request){
        $data = $request->validate([
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

        return $registrant;
    }

}
