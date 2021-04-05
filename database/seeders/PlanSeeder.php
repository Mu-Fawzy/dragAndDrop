<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = Plan::factory(30)->create();
        $boxIds = DB::table('boxes')->pluck('id')->toArray();
        $plans->each(function($plan) use($boxIds)
        {
            $plan->boxes()->sync(array_rand( $boxIds, 2 ));
        });
    }
}
