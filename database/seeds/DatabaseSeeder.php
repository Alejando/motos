<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(CategorySeeder::class);
        $this->call(AuctionsSeeder::class);
        $this->call(PreferencesFactory::class);
        $this->call(UsersSeeder::class);
        $this->call(AddressesSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(EnrollementsSeeder::class);
        //$this->call(UsersTableSeeder::class);
    }

}
