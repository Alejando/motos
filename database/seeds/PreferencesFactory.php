<?php

use Illuminate\Database\Seeder;

class PreferencesFactory extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\GlimGlam\Models\Preference::class, 15)
            ->create();
    }
}
