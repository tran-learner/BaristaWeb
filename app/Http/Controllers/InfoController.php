<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function getInfo(){
        $infos = config('drinks.teaminfo')['team_info'];
        return view('teamInfo', compact('infos'));
    }
}
