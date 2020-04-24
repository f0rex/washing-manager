<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Vehicle;
use App\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{

    public function wash($id)
    {
        $schedule = Schedule::find($id);
        $schedule->washed_at = now();
        $schedule->save();
        if ($schedule->type == 'internal') {
            $schedule->vehicle->last_washed_internally_at = now();
        }
        if ($schedule->type == 'external') {
            $schedule->vehicle->last_washed_externally_at = now();
        }
        $schedule->vehicle->save();
        return redirect()->route('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all()->sortBy('scheduled_at');
        return view('schedule.index', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.create', [
            'groups' => Group::all(),
            'vehicles' => Vehicle::all()
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
        //dd($request->all());
        $schedule = new Schedule;
        $schedule->scheduled_at = Carbon::parse($request->scheduled_at);
        $schedule->type = $request->type;
        $schedule->vehicle()->associate($request->vehicle);
        $schedule->save();

        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('schedule.edit', [
            'schedule' => Schedule::find($id),
            'vehicles' => Vehicle::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $schedule = Schedule::find($id);

        $schedule->type = $request->type;
        $schedule->scheduled_at = Carbon::parse($request->scheduled_at);
        if ($request->washed_at == NULL) {
            $schedule->washed_at = NULL;
        } else {
            $schedule->washed_at = Carbon::parse($request->washed_at);
        }
        $schedule->vehicle()->associate($request->vehicle);
        $schedule->save();
    
        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::destroy($id);
        return redirect()->route('schedule.index');
    }
}
