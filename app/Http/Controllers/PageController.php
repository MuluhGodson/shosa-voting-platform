<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;


class PageController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function apply()
    {
        $contest = Contest::where('active',true)->first();
        if(!$contest) return view('user.application.index');
        return view('user.application.apply', compact('contest'));
        //
    }

    public function application(Contest $contest)
    {
        return view('user.application.apply', compact('contest'));
    }


    public function dashboard()
    {
        $contests = Contest::all();
        if($contests){
            foreach($contests as $contest){
                $cName[] = $contest->name;
                $cbDate[] = $contest->beginning_date;
                $ceDate[] = $contest->ending_date;
            }
        }
       
        return view('dashboard');
    }

    public function finance()
    {
        return view('admin.finance.index');
    }
}
