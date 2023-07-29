<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function getEvent()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                ->get(['id', 'title', 'start', 'end' ,'category']);
            return response()->json($events);
        }
        return view('event.event');
    }
    public function createEvent(Request $request)
    {
        $data = $request->except('_token');
        $events = Event::insert($data);
        return response()->json($events);
    }

    // public function deleteEvent(Request $request)
    // {
    //     $event = Event::find($request->id);
    //     return $event->delete();
    // }
    public function updateEvent(Request $request)
    {
        $eventId = $request->id;
        $event = Event::find($eventId);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->category = $request->category;
        $event->save();

        return response()->json(['message' => 'Event updated successfully'], 200);
    }

}
