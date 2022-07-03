<?php
namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(10)->create();
        User::factory(10)->create();
        Session::factory(5)->create([
            'appointment' => Carbon::now()
        ]);
        Session::factory(5)->create([
            'activated' => Carbon::now()
        ]);
        $this->call(UserSeeder::class);

    }
}
