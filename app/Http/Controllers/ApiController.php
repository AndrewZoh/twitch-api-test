<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stream;
use App\Http\Resources\StreamResource;

class ApiController extends Controller
{
    protected $games, $dateFrom, $dateTo, $page;

    public function __construct(Request $request)
    {
        $this->games = $request->games;
        $this->dateFrom = $request->dateFrom;
        $this->dateTo = $request->dateTo;
        $this->page = $request->page ?? 1;
    }

    /**
     * Вернет список потоков по переданным или всем играм
     * При запросе без дат вернет данные с последней синхронизации
     * При запросе с датами если попадет несколько записей одного стрима
     * вернет все записи
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function streams()
    {
        $streams = Stream::games($this->games)
            ->byDate($this->dateFrom, $this->dateTo)
            ->paginate(20, null, 'page', $this->page);

        return StreamResource::collection($streams);
    }

    /**
     * Вернет количество просмотров по переданным или всем играм
     * При запросе без дат вернет данные с последней синхронизации
     * При запросе с датами если попадают несколько записей одного стрима
     * посчитает количество просмотров только для одного из этих стримов
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function streamsCount()
    {
        return response()->json(
            [
                'viewer_count' => Stream::games($this->games)
                    ->byDate($this->dateFrom, $this->dateTo)
                    ->get()
                    ->unique('twitch_stream_id')
                    ->sum('viewer_count')
            ]
        );
    }
}
