<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function streams()
    {
        return 'test';
    }

    public function streamsCount()
    {
        return 'test';
    }
}
