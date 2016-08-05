<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\GlimGlam\Models\User::class, 3)->create()->each(function($user){
            factory(\GlimGlam\Models\Address::class, rand(0, 2))
                ->create(['user'=>$user->id]);
        });
    }
}
