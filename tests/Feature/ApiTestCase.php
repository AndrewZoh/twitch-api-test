<?php
/**
 * Created by PhpStorm.
 * User: legat
 * Date: 08/02/2018
 * Time: 21:24
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Stream;
use App\Game;

class ApiTestCase extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $games;

    protected function setUp()
    {
        parent::setUp();

        $this->games = factory(Game::class, 3)->create();

        factory(Stream::class, 10)->create([
            'game' => $this->games[0]->name,
        ]);
        factory(Stream::class, 10)->create([
            'game' => $this->games[1]->name,
        ]);
        factory(Stream::class, 10)->create([
            'game'          => $this->games[2]->name,
            'is_current'    => 0,
            'created_at'    => date('Y-m-d H:i:s', strtotime('yesterday'))
        ]);
    }
}