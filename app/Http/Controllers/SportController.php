<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SportResource;
use App\Models\Sport;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isNan;

class SportController extends Controller
{
    public function show(){
        return SportResource::collection(Sport::all());
    }
}
