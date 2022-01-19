<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name'      => 'admin',
                'password'  => 'admin',
            ],
        ];

        DB::transaction(function () use ($users) {
            foreach ($users as $user) {
                User::create([
                    'name'      => $user['name'],
                    'password'  => bcrypt($user['password']),
                ]);
            }
        });
    }
}
