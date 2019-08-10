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

<<<<<<< HEAD
   public function deleteSchedule(Request $request){
=======
   public function deleteSchedule(Request $request){  
>>>>>>> 608b895d249cec115f1019fa9415be03593cb996
    \Log::info($request);
    $schedule = Schedule::where('id', $request->id)->delete();
    $schedules = Schedule::all();
    return $schedules;
  }
  
  public function editSchedule(int $id, int $schedule_id, editSchedule $request)
  { 
    \Log::info($request);
    $schedule = Schedule::find($schedule_id);
    $schedule->title = $request->input('title','');
    $schedule->go_date = $request->input('go_date','');
    $schedule->return_date = $request->input('return_date','');
    $schedule->save();
}

}   