<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSchedule;
use App\Event;
use Illuminate\Support\Facades\DB;





class ScheduleController extends Controller
{
 public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }


  
 public function createSchedule(StoreSchedule $request)
  {     
        \Log::info($request);
        $schedule = new Schedule();
        $schedule->title = $request->get('title');
        $schedule->go_date=$request->get('go_date');
        $schedule->return_date=$request->get('return_date');
        $schedule->user_id = Auth::user()->id;
 
        Auth::user()->schedules()->save($schedule);
        
        $new_schedule = Schedule::where('id', $schedule->id)->with('owner')->first();


        return response($schedule, 201);

    }
    
    public function index()
{
    $schedules = Schedule::with(['owner'])
        ->orderBy(Schedule::CREATED_AT, 'desc')->paginate();

    return $schedules;
}

   public function deleteSchedule(Request $request){  
    $schedule = Schedule::where('id', $request->id)->delete();
    $schedules = Schedule::all();
    return $schedules;
  }

}   