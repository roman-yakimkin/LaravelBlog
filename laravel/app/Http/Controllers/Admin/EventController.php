<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $v = 'admin.events.index';

        return view($v, [
            'events' => Event::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create', [
            'event' => [],
            'event_dates' => ['01.01.2500'],
            'delimiter' => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());

        if ($request->input('dates_result')){
            $dates = explode(",", $request->input('dates_result'));
            $datetimes = [];
            foreach($dates as $one_date){
                $newtime = \DateTime::createFromFormat('d.m.Y', $one_date);
                //dd($newtime->format('Y-m-d'));
                $datetimes[] = new \App\EventDates(['event_date' => $newtime->format('Y-m-d')]);
            }
            $event->dates()->saveMany($datetimes);
        }
        return redirect()->route('admin.event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', [
           'event' => $event,
           'delimiter' => 0,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update();

//        $event->dates()->detach();

        if ($request->input('dates')){
//            $event->dates()->attach($request->input('dates'));
        }

        return redirect()->route('admin.event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->dates()->delete();
        $event->delete();

        return redirect()->route('admin.event.index');
    }
}
