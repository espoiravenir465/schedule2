<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
  public function index(Request $request)
  {
    \Log::info($request->id);
    $events = Event::where('schedule_id', $request->id)->orderBy(Event::CREATED_AT, 'desc')->paginate();
    return $events;
  }
  public function dateindex(Request $request)
  {
    \Log::info("event1");
    \Log::info($request->id);
    $events = Event::where('schedule_id', $request->id)->where('event_date', $request->date)->orderBy(Event::CREATED_AT, 'desc')->paginate();
    \Log::info("event2");
    return $events;
  }
  public function createEvent(Schedule $schedule, Request $request)
  {     
    \Log::info("controller");
    \Log::info($request->get('schedule_id'));
    \Log::info($request);
    $event = new Event();
    $schedule = Schedule::where('id', $request->get('schedule_id'));
    $event->schedule_id=$request->get('schedule_id');
    $event->event_title=$request->get('event_title');
    $event->event_date=$request->get('event_date');
    $event->event_start=$request->get('event_start');
    $event->event_end=$request->get('event_end');
    \Log::info($event);
    \Log::info("test1");
    //\Log::info($schedule);
    \Log::info("test2");
    $event->save();
    //$schedule->events()->save($event);
    $new_event = Event::where('event_id', $event->event_id)->first();
    return response($new_event, 201);
  }
}
