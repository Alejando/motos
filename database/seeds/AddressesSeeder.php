<?php

use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {       
        $users = \GlimGlam\Models\User::getAll();
        foreach($users as $user){
            factory(\GlimGlam\Models\Address::class, rand(0, 2))
                ->create(['user'=>$user->id]);
        }
    }
}
