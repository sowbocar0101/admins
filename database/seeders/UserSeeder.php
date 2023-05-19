<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'envatotaxi',
                'password' => bcrypt('envatotaxi'),
                'status' => 1,
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
