<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $people = [
            ['firstname' => 'Admin', 'lastname' => 'Administrator', 'phone' => '+237699999999', 'email'=>'admin@gmail.com']
        ];

        foreach($people as $person){

            $item = new Person();
            $item->firstname = $person['firstname'];
            $item->lastname = $person['lastname'];
            $item->phone = $person['phone'];
            $item->email = $person['email'];
            $item->save();
        }
    }
}
