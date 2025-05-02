<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function getInfo(){
        $infos = config('drinks.teaminfo')['team_info'];
        // $facebook = $infos['facebook'];
        // $email= $infos['email'];
        // $imagePath = $infos['imagePath'];
        return view('teamInfo', compact('infos'));
    }
}
