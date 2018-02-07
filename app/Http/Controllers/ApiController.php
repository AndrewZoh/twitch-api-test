<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;

class ApiController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function streams()
    {
        return response()->json(Stream::where('is_current', 1)->get()->toArray());
    }

    public function streamsCount()
    {
        $count = Stream::where('is_current', 1)->pluck('game', 'viewer_count');

        return 'test';
    }
}
