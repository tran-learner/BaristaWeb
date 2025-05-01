<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request){
        $info = $request->query('info');
        $infos = config('drinks.teaminfo')['team_info'];
        $infoName = collect($infos)->firstWhere('name', $info);
        if (!$infoName){ abort(404, 'info not found');}
        $facebook = $infoName['facebook'];
        $telZalo= $infoName['tel/zalo'];
        return view("memberPage",compact('facebook','info','telZalo'));
    }
}
