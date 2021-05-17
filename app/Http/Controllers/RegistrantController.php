<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Resources\RegistrantResource;
use App\Http\Resources\RegistrationResource;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RegistrantController extends Controller
{
    /**
     * Return all registrants
     *
     * @return \App\Http\Resources\RegistrantResource
     */
    public function index(): RegistrantResource
    {
        return new RegistrantResource(auth()->user()->registrants);
    }

    /**
     * shows the registrant
     *
     * @param $id
     * @return \App\Http\Resources\RegistrantResource
     */
    public function show($id): RegistrantResource
    {
        return new RegistrantResource(auth()->user()->registrants()->find($id));
    }

    /**
     * updates the registration resource
     *
     * @param \App\Http\Requests\StoreRegistrantRequest $request The request body
     * @param int $id The id of the registrant
     * @return \App\Http\Resources\RegistrationResource The created registrant data
     */
    public function update(StoreRegistrantRequest $request, int $id): RegistrationResource
    {
        $registrant = auth()->user()->registrants()->find($id);
        $registrant->fill($request->validated())->save();
        return new RegistrationResource($registrant);
    }

    /**
     * stores a registrant
     *
     * @param \App\Http\Requests\StoreRegistrantRequest $request
     * @return mixed
     */
    public function store(StoreRegistrantRequest $request)
    {
        return new RegistrationResource(auth()->user()->registrants()->create($request->validated()));
    }
}
