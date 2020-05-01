<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Group;
use App\Vehicle;
use App\Schedule;
use Carbon\Carbon;

class GeneratorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        $vehicles = Vehicle::all();
        return view('generator.create', [
            'groupsNotCreated' => $groups->isEmpty(),
            'vehiclesNotCreated' => $vehicles->isEmpty(),
        ]);
    }

    public function generate(Request $request)
    {
        $validatedData = $request->validate([
            'weeks' => ['required', 'integer'],
        ]);

        DB::table('schedules')->truncate();

        $weeks = $request->weeks;
        $months = $weeks / 4;
        $groups = Group::all();

        for ($i=0; $i < $months; $i++) {
            foreach ($groups as $group) {

                $workingDays = new Collection;
                for ($j=0; $j < 28; $j++) { 
                    $day = Carbon::tomorrow()->addDays($i*28 + $j);
                    if ($group->{strtolower($day->locale('en')->isoFormat('ddd'))}) {
                        $workingDays->push($day);
                    }
                }

                $timesToWashEachVehicleInternally = $group->internal;
                $vehicles = $group->vehicles->sortBy('last_washed_internally_at');
                $vehiclesToWashInternally = Collection::times($timesToWashEachVehicleInternally, function ($number) use ($vehicles) {
                    return $vehicles;
                })->collapse(); 

                $timesToWashEachVehicleExternally = $group->external;
                $vehicles = $group->vehicles->sortBy('last_washed_externally_at');
                $vehiclesToWashExternally = Collection::times($timesToWashEachVehicleExternally, function ($number) use ($vehicles) {
                    return $vehicles;
                })->collapse();

                $position = -1;
                while ($vehiclesToWashInternally->count() > 0) {
                    $frequency = (int)ceil(($workingDays->count() - ( 1  + $position)) / $vehiclesToWashInternally->count());
                    $vehiclesToWashPerDay = (int)ceil($vehiclesToWashInternally->count() / ($workingDays->count() - ( 1  + $position)));
                    $position = $position + $frequency;
                    for ($k=0; $k < $vehiclesToWashPerDay; $k++) {
                        if ($vehiclesToWashInternally->isNotEmpty()) {
                            $schedule = new Schedule;
                            $schedule->scheduled_at = $workingDays->get($position);
                            $schedule->type = 'internal';
                            $schedule->vehicle()->associate($vehiclesToWashInternally->shift());
                            $schedule->save();
                        } 
                    }
                }

                $position = -1;
                while ($vehiclesToWashExternally->count() > 0) {
                    $frequency = (int)ceil(($workingDays->count() - ( 1  + $position)) / $vehiclesToWashExternally->count());
                    $vehiclesToWashPerDay = (int)ceil($vehiclesToWashExternally->count() / ($workingDays->count() - ( 1  + $position)));
                    $position = $position + $frequency;
                    for ($k=0; $k < $vehiclesToWashPerDay; $k++) {
                        if ($vehiclesToWashExternally->isNotEmpty()) {
                            $schedule = new Schedule;
                            $schedule->scheduled_at = $workingDays->get($position);
                            $schedule->type = 'external';
                            $schedule->vehicle()->associate($vehiclesToWashExternally->shift());
                            $schedule->save();
                        } 
                    }
                }
            }
        }



        /*DB::table('schedules')->truncate();
        $weeks = $request->weeks;
        $groups = Group::all();
        foreach ($groups as $group) {
            $workingDaysInAWeek = $group->mon + $group->tue + $group->wed + $group->thu + $group->fri + $group->sat = $group->sun;
            $timesToWashEachVehicleInternally = $group->internal * $weeks / 4;
            $timesToWashEachVehicleExternally = $group->external * $weeks / 4;
            $vehicles = $group->vehicles->sortBy('last_washed_internally_at');
            $vehiclesToWashInternally = Collection::times($timesToWashEachVehicleInternally, function ($number) use ($vehicles) {
                return $vehicles;
            })->collapse();
            $vehicles = $group->vehicles->sortBy('last_washed_externally_at');
            $vehiclesToWashExternally = Collection::times($timesToWashEachVehicleExternally, function ($number) use ($vehicles) {
                return $vehicles;
            })->collapse();
            // Calculating day left for each category for the span of time 
            $workingDaysLeftForInternal = $workingDaysInAWeek * $weeks;
            $workingDaysLeftForExternal = $workingDaysInAWeek * $weeks;
            $day = now();
            for ($i=0; $i < 7 * $weeks; $i++) { 
                $day = $day->add(1, 'day');

                if ($group->{strtolower($day->locale('en')->isoFormat('ddd'))} && $workingDaysLeftForInternal > 0) {
                    $vehiclesPerDay = ceil($vehiclesToWashInternally->count() / $workingDaysLeftForInternal);
                    for ($j=0; $j < $vehiclesPerDay; $j++) {
                        if ($vehiclesToWashInternally->isNotEmpty()) {
                            $schedule = new Schedule;
                            $schedule->scheduled_at = $day;
                            $schedule->type = 'internal';
                            $schedule->vehicle()->associate($vehiclesToWashInternally->shift());
                            $schedule->save();
                        } 
                    }
                    $workingDaysLeftForInternal--;
                }
                
                if ($group->{strtolower($day->locale('en')->isoFormat('ddd'))} && $workingDaysLeftForExternal > 0) {
                    $vehiclesPerDay = ceil($vehiclesToWashExternally->count() / $workingDaysLeftForExternal);
                    for ($j=0; $j < $vehiclesPerDay; $j++) {
                        if ($vehiclesToWashExternally->isNotEmpty()) {
                            $schedule = new Schedule;
                            $schedule->scheduled_at = $day;
                            $schedule->type = 'external';
                            $schedule->vehicle()->associate($vehiclesToWashExternally->shift());
                            $schedule->save();
                        } 
                    }
                    $workingDaysLeftForExternal--;
                }
            }
        }*/

        return redirect()->route('index')->with('success', 'Calendario generato con successo');
    }
}
