<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isNan;

class SportController extends Controller
{
    public function show(){
        try {
            $sports = Sport::all();
            return response()->json($sports, 200);
        }catch (Exception $e){
            $code = !isNan($e->getCode()) ? $e->getCode() : 400;
            return response()->json(['message' => $e->getMessage()], $code);
        }
    }
}
