<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Poly;
use App\Models\User;
use App\Models\Medicine;
use DB;

class LayoutController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        if($user->level=='R001') {
            return redirect ('/admin')->with('user', $user);
        } elseif($user->level=='R002') {
            return redirect ('/receptionist')->with('user', $user);
        } elseif($user->level=='R003') {
            return redirect ('/doctor')->with('user', $user);
        } elseif($user->level=='R004') {
            return redirect ('/pharmacy')->with('user', $user);
        } elseif($user->level=='R005') {
            return redirect ('/finance')->with('user', $user);
        }

    }

    public function test() 
    {
        $users = User::all()->where('level', 'R003');
        $poly = Poly::all()->sortDesc();
        $medicine = Medicine::all();
        $mdclist = Medicine::all()->sortBy("MEDICINE_NAME");
        
        return view ('test')->with([
            'user' => Auth::user(),
            'users' => $users,
            'poly' => $poly,
            'medicine' => $medicine,
            'mdclist'=> $mdclist
        ]);
    }

}
