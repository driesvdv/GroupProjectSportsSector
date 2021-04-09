<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isNan;

class UserController extends Controller
{
    public function show(){
        return new UserResource(Auth::user());
    }

    public function store(Request $request){
        $user = $this->ValidateUser($request, new User());

        return new UserResource($user);
    }

    public function update(Request $request){
        $user = $this->ValidateUser($request, Auth::user());

        return new UserResource($user);
    }

    private function ValidateUser(Request $request, $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        return $user;
    }
}
