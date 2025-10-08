<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use App\Models\User;


class WeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)->create();

        $user = User::factory()->create();
        WeightTarget::factory()->count(1)->create(['user_id' => $user->id,]);
        WeightLog::factory()->count(35)->create(['user_id' => $user->id,]);
    }
}
