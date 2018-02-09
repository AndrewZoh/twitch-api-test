<?php

namespace Tests\Feature;

use App\Stream;

class StreamsCountTest extends ApiTestCase
{
    public function testStreamsCountAll()
    {
        $count = Stream::where('is_current', 1)->get()->sum('viewer_count');

        $response = $this->json('GET', '/api/streams/count');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'viewer_count' => $count,
            ]);
    }

    public function testStreamsCountOneGame()
    {
        $count = Stream::where('game', $this->games[0]->name)->get()->sum('viewer_count');

        $response = $this->json('GET', '/api/streams/count?games[]='.$this->games[0]->name);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'viewer_count' => $count,
            ]);
    }

    public function testStreamsCountByDate()
    {
        $count = Stream::where('is_current', 0)->get()->sum('viewer_count');

        $response = $this->json('GET', '/api/streams/count?dateTo[]='.date('Y-m-d H:i:s', strtotime('yesterday')));

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'viewer_count' => $count,
            ]);
    }
}
