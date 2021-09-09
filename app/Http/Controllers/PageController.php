<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use Acaronlex\LaravelCalendar\Event;
use Acaronlex\LaravelCalendar\Calendar;


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
       
        $calendar = new Calendar();
        $i = count($contests);
        if($i > 0)
        {
            for($j = 0; $j < $i; $j++)
            {
                $events[] = $calendar::event(
                    $cName[$j], //event title
                    true, //full day event?
                    $cbDate[$j], //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                    $ceDate[$j], //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
                    1, //optional event ID
                    [
                        'url' => route('contest.index')
                    ]
                );
            }
        } else {
            $events = [];
        }
       
        $calendar->addEvents($events);
        $calendar->setId('1');

        return view('dashboard', compact('calendar'));
    }

    public function finance()
    {
        return view('admin.finance.index');
    }
}
