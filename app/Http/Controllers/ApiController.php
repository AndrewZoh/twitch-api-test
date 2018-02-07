<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;

class ApiController extends Controller
{
    protected $games, $dateFrom, $dateTo;

    public function __construct(Request $request)
    {
        $this->games = $request->games;
        $this->dateFrom = $request->dateFrom;
        $this->dateTo = $request->dateTo;
    }

    public function streams()
    {
        return response()->json(
            Stream::where('is_current', 1)
                ->when($games = $this->games, function ($query) use ($games) {
                    return $query->whereIn('game', $games);
                })
                ->when($dateFrom = $this->dateFrom, function ($query) use ($dateFrom) {
                    return $query->whereDate('created_at', '<=', $dateFrom);
                })
                ->when($dateTo = $this->dateTo, function ($query) use ($dateTo) {
                    return $query->whereDate('created_at', '>=', $dateTo);
                })
                ->get()->toArray());
    }

    public function streamsCount()
    {
        return response()->json(['count' => Stream::where('is_current', 1)->sum('viewer_count')]);
    }
}
