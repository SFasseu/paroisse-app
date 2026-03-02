<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email'=>'admin@gmail.com', 'password'=>'12345678']
        ];

        foreach ($users as $key => $user) {
            $item = new User();
            $item->name = $user['name'];
            $item->email = $user['email'];
            $item->password = $user['password'];
            $item->save();
        }
    }
}
