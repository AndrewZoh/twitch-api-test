<?php
/**
 * Created by PhpStorm.
 * User: legat
 * Date: 08/02/2018
 * Time: 21:24
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Stream;

class ApiTestCase extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    protected $streams;

    protected function setUp()
    {
        parent::setUp();

        factory(Stream::class, 10)->create([
            'game' => 'Fallout: New Vegas'
        ]);
        factory(Stream::class, 10)->create([
            'game' => 'Starcraft'
        ]);
    }
}