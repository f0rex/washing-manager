<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Group;
use Carbon\Carbon;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicle.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.create', ['groups' => Group::all()]);
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
        $validatedData = $request->validate([
            'plate' => ['required', 'string'],
            'group' => ['required', 'exists:groups,id'],
        ]);
        $vehicle = new Vehicle;
        $vehicle->plate = $request->plate;
        $vehicle->group()->associate($request->group);
        $vehicle->save();

        return redirect()->route('vehicle.index')->with('success', 'Veicolo aggiunto con successo');
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
        return view('vehicle.edit', [
            'vehicle' => Vehicle::find($id),
            'groups' => Group::all()
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
        $validatedData = $request->validate([
            'plate' => ['required', 'string'],
            'group' => ['required', 'exists:groups,id'],
            'last_washed_internally_at' => ['nullable', 'date'],
            'last_washed_externally_at' => ['nullable', 'date'],
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->plate = $request->plate;
        if ($request->last_washed_internally_at == NULL) {
            $vehicle->last_washed_internally_at = NULL;
        } else {
            $vehicle->last_washed_internally_at = Carbon::parse($request->last_washed_internally_at);
        }
        if ($request->last_washed_externally_at == NULL) {
            $vehicle->last_washed_externally_at = NULL;
        } else {
            $vehicle->last_washed_externally_at = Carbon::parse($request->last_washed_externally_at);
        }
        $vehicle->group()->associate($request->group);
        $vehicle->save();

        return redirect()->route('vehicle.index')->with('success', 'Veicolo aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::destroy($id);
        return redirect()->route('vehicle.index')->with('success', 'Veicolo eliminato con successo');
    }
}
