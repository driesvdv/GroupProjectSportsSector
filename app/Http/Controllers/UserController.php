<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $code = !isNan($e->getCode()) ? $e->getCode() : 400;
            return response()->json(['message' => $e->getMessage()], $code);
        }
    }
}
