<?php

use Illuminate\Database\Seeder;

class EnrollementsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        GlimGlam\Models\Auction::getAll()->each(function($auntion){
            GlimGlam\Models\User::getRandom(rand(0, 10))->each(function($user) use ($auntion) {
                $user->enroll($auntion->id, rand(1000, 3000));
            });
        });
    }

}
