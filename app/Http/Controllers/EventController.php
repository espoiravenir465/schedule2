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
    $event->edit_title = false;
    $event->edit_start = false;
    $event->edit_end = false;
    \Log::info($event);
    \Log::info("test1");
    //\Log::info($schedule);
    \Log::info("test2");
    $event->save();
    //$schedule->events()->save($event);
    $new_event = Event::where('id', $event->id)->first();
    return response($new_event, 201);
  }
  public function destroy(Request $request)
  {
    \Log::info("delete");
    \Log::info($request->id);
    \Log::info($request->schedule_id);
    $event = Event::where('id', $request->id)->delete();
    $events = Event::all();
    return $events;
  }
  public function editEvent(Request $request)
  {
    //\Log::info("edit");
    \Log::info($request->all());
    $events = $request->all();
    foreach ($events as $event)
    {
      //\Log::info($event);
      //Event::where('id', $event['id'])->update(['event_title' => $event['event_title']],['event_start' => $event['event_start']],['event_end' => $event['event_end']]);
      Event::where('id', $event['id'])->update(['event_title' => $event['event_title']]);
      Event::where('id', $event['id'])->update(['event_start' => $event['event_start']]);
      Event::where('id', $event['id'])->update(['event_end' => $event['event_end']]);
     }
  }
  public function Eventdetailindex(Request $request)
  {
    \Log::info('Eventdetailindex');
    \Log::info($request);
     $event = Event::where('id', $request->get('id'))->get();
    \Log::info($event);
    \Log::info('testend');
    return $event;
  }



}
