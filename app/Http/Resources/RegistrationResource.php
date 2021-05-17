<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'group_id' => $this->group_id,
            'has_paid' => $this->has_paid,
            'registrant_id' => $this->registrant_id,
            'club' => $this->group->sportClub,
            'group' => $this->group,
        ];
    }
}
