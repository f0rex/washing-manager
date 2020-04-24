<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Group;
use App\Vehicle;
use App\Schedule;

class ShowIndex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $schedules = Schedule::all()->sortBy('scheduled_at')->groupBy(['scheduled_at', 'type']);
        $groups = Group::all();
        $vehicles = Vehicle::all();
        if ($schedules->isEmpty()) {
            return view('generator.create', [
                'groupsNotCreated' => $groups->isEmpty(),
                'vehiclesNotCreated' => $vehicles->isEmpty(),
            ]);
        } else {
            return view('index', ['schedules' => $schedules]);
        }
    }


    /*public function __invoke(Request $request)
    {
        $groups = Group::all();
        $group = $groups->first();
        $workingDaysInAWeek = $group->mon + $group->tue + $group->wed + $group->thu + $group->fri + $group->sat = $group->sun;
        $timesToWashEachVehicleInternallyInAMonth = $group->internal;
        $timesToWashEachVehicleExternallyInAMonth = $group->external;
        $vehicles = $group->vehicles->sortBy('last_washed_internally_at');
        $vehiclesToWashInternally = Collection::times($timesToWashEachVehicleInternallyInAMonth, function ($number) use ($vehicles) {
            return $vehicles;
        })->collapse();
        $vehicles = $group->vehicles->sortBy('last_washed_externally_at');
        $vehiclesToWashExternally = Collection::times($timesToWashEachVehicleExternallyInAMonth, function ($number) use ($vehicles) {
            return $vehicles;
        })->collapse();

        //$daysLeft = $workingDaysInAWeek * 4;
        //$vehiclesPerDay = ceil($vehiclesToWashInternally->count() / $daysLeft);

        $workingDaysLeftForInternal = $workingDaysInAWeek * 4;
        $workingDaysLeftForExternal = $workingDaysInAWeek * 4;

        //$vehicles = Vehicle::orderBy('last_washed_at', 'asc')->get();
        $day = now();
        //dd($today->toDateString());
        $schedule = new Collection;
        for ($i=0; $i < 28; $i++) { 
            $day = $day->add(1, 'day');
            $dayOfTheWeek = $day->locale('it')->isoFormat('dddd');
            $vehiclesToWashInternallyForTheDay = new Collection;
            $vehiclesPerDay = ceil($vehiclesToWashInternally->count() / $workingDaysLeftForInternal);
            if ($group->{strtolower($day->locale('en')->isoFormat('ddd'))}) {
                for ($j=0; $j < $vehiclesPerDay; $j++) {
                    if ($vehiclesToWashInternally->isNotEmpty()) {
                        $vehiclesToWashInternallyForTheDay->push($vehiclesToWashInternally->shift());
                    } 
                }
                $workingDaysLeftForInternal--;
            }
            //dd($vehiclesToWashInternallyForTheDay);
            $vehiclesToWashExternallyForTheDay = new Collection;
            $vehiclesPerDay = ceil($vehiclesToWashExternally->count() / $workingDaysLeftForExternal);
            if ($group->{strtolower($day->locale('en')->isoFormat('ddd'))}) {
                for ($j=0; $j < $vehiclesPerDay; $j++) {
                    if ($vehiclesToWashExternally->isNotEmpty()) {
                        $vehiclesToWashExternallyForTheDay->push($vehiclesToWashExternally->shift());
                    } 
                }
                $workingDaysLeftForExternal--;
            }
            $schedule->push([
                'date' => $day->toDateString(),
                'dayOfTheWeek' => $dayOfTheWeek,
                'vehiclesToWashInternallyForTheDay' => $vehiclesToWashInternallyForTheDay,
                'vehiclesToWashExternallyForTheDay' => $vehiclesToWashExternallyForTheDay,
                ]);
        }
        //dd($schedule);
        return view('index', [
            'groups' => $groups,
            'schedule' => $schedule
            ]);
    }*/
}
