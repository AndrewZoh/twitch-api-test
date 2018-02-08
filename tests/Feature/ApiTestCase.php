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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ApiTestCase extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp()
    {
        parent::setUp();
    }
}