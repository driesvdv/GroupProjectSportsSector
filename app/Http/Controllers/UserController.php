<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isNan;

class UserController extends Controller
{
    public function show(){
        try {
            $user = Auth::user();
            return response()->json([$user], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function store(Request $request){
        try {
            $user = new User();
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->save();

            return response()->json([$user], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(){
        try {
            $user = Auth::user();
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required'
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];

            return response()->json([$user], 200);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
