<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon;

class EeventController extends Controller
{
    // Start Controller Function to show all Gooogle Calenders Events
public function showevents()
{
     // get all future events on a calendar
        $events = Event::get();
        $data=compact('events');
        return view('dashboard')->with($data);
}
// End Controller Function to show all Gooogle Calenders Events

// Start Controller Function to Add New Gooogle Calender Event
public function addevents(Request $req)
    {
          
        
         session()->put('id1',10);
         $req->validate([
               'event'=>'required',
               'description'=>'required',
               'start_date'=>'required',
               'start_time'=>'required',
               'end_date'=>'required',
               'end_time'=>'required'

         
         ]);


          //create a new event
           $event = new Event;

          $event->name = $req->event;
          $event->description = $req->description;
          $event->startDateTime =Carbon\Carbon::parse($req->start_date.$req->start_time,'Asia/Calcutta');
          $event->endDateTime = Carbon\Carbon::parse($req->end_date.$req->end_time,'Asia/Calcutta');
          $event->save();
          return redirect('/');

    }
// End Controller Function to Add New Gooogle Calender Event


// Start Controller Function to Delete Gooogle Calender Event
    public function delevents(Request $req)
    {
        $event = Event::find($req->id);

        $event->delete();
        return redirect('/');
    }
  
    // Start Controller Function to Delete Gooogle Calender Event
    

// Start Controller Function to open Edit Event Modal Form
    public function show_update($id)
    {
           
        $event1 = Event::find($id);
        $events=Event::get();
        if(is_null($event1))
           {
                //not found
                return redirect()->back();
           }
          else
           {
              
              
                $data=compact('event1','events');
                return view('showevents')->with($data);

        }
}

// End Controller Function to open Edit Event Modal Form

 
// Start: Controller  function to update Event
    public function edit_event($id, Request $req)
    {
       
        $event = Event::find($id);
        $event->name = $req->event;;
        $event->description = $req->description;
        $event->startDateTime = Carbon\Carbon::parse($req->start_date.$req->start_time,'Asia/Calcutta');;
        $event->endDateTime =  Carbon\Carbon::parse($req->end_date.$req->end_time,'Asia/Calcutta');
        $event->save(); 
        return redirect('/');

     
    }
// End: Controller  function to update Event
}
