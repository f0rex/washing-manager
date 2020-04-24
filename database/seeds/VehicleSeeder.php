<?php

use Illuminate\Database\Seeder;
use App\Group;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carsGroup = Group::find(1);
        $cars = factory(App\Vehicle::class, 30)
            ->make()
            ->each(function ($vehicle) use ($carsGroup) {
                $vehicle->group()->associate($carsGroup)->save();
            });

        $vansGroup = Group::find(2);
        $vans = factory(App\Vehicle::class, 20)
            ->make()
            ->each(function ($vehicle) use ($vansGroup) {
                $vehicle->group()->associate($vansGroup)->save();
            });
    }
}
