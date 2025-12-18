<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Role::all()->count() == 0) {
            Role::create([
                'name' => 'admin'
            ]);

            Role::create([
                'name' => 'manager'
            ]);
        };
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            TicketSeeder::class
        ]);
    }
}
