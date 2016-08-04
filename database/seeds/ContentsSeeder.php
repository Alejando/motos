<?php

use Illuminate\Database\Seeder;

class ContentsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create('es_ES');
        $contents=[
            ['Acerca de', 'acerca-de-glim-glam', join("<br>",$faker->paragraphs(rand(1, 2),false))],
            ['Guía de uso', 'guia-de-uso', join("<br>",$faker->paragraphs(rand(1, 2),false))],
            ['Aviso de privasidad', 'aviso-de-privasidad', join("<br>",$faker->paragraphs(rand(1, 2),false))],
            ['Términos y codiciones', 'terminos-y-condiciones', join("<br>",$faker->paragraphs(rand(1, 2),false))]
        ];
        foreach ($contents as $content){
            GlimGlam\Models\Content::create([
                'name' => $content[0],
                'slug' => $content[1],
                'content' => $content[2]
            ])->save();
        }
    }

}
