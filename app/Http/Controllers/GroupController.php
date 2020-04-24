<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Vehicle;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('group.index', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
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
        $group = new Group;
        $group->name = $request->name;
        foreach ($request->days as $day) {
            $group->{$day} = TRUE;
        }
        $group->internal = $request->internal;
        $group->external = $request->external;
        $group->save();

        foreach ($request->plates as $plate) {
            $vehicle = new Vehicle;
            $vehicle->plate = $plate;
            $vehicle->group()->associate($group);
            $vehicle->save();
        }

        return redirect()->route('group.index');
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
        return view('group.edit', ['group' => Group::find($id)]);
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
        $group = Group::find($id);
        $group->name = $request->name;
        $group->mon = $group->tue = $group->wed = $group->thu = $group->fri = $group->sat = $group->sun = FALSE;
        foreach ($request->days as $day) {
            $group->{$day} = TRUE;
        }
        $group->internal = $request->internal;
        $group->external = $request->external;
        $group->save();

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
        return redirect()->route('group.index');
    }
}
