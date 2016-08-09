<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
         $sub1 = GlimGlam\Models\Auction::getByCode('SUB-001');
         $this->equalTo($sub1->id,1);
//         dd();
//        $this->visit('/')
//             ->see('Laravel 5');
    }
}
