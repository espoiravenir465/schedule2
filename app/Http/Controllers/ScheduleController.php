<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSchedule;
use App\Event;
use Illuminate\Support\Facades\DB;





class ScheduleController extends Controller{
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
        $schedule->edit_title = false;
        $schedule->edit_go_date = false;
        $schedule->edit_return_date = false;
 
        Auth::user()->schedules()->save($schedule);
        
        $new_schedule = Schedule::where('id', $schedule->id)->with('owner')->first();


        return response($schedule, 201);

    }
    
    public function index(){
    $schedules = Schedule::with(['owner'])
        ->orderBy(Schedule::CREATED_AT, 'desc')->paginate();
    return $schedules;
}

   public function deleteSchedule(Request $request){
    \Log::info("delete");
    \Log::info($request);
    $schedule = Schedule::where('id', $request->id)->delete();
    $schedules = Schedule::all();
    return $schedules;
  }
  
 public function editSchedule(Request $request)
  {
    \Log::info("edit");
    //\Log::info($request->all());
    $schedules = $request->all();
    foreach ($schedules as $schedule) {
      \Log::info($schedule);
      \Log::info($schedule['title']);
      Schedule::where('id', $schedule['id'])->update(['title' => $schedule['title']],['go_date' => $schedule['go_date']],['return_date' => $schedule['return_date']]);
    }

  }
}