<?php

namespace Tests\Feature;

use App\Stream;

class StreamsTest extends ApiTestCase
{

    public function testStreamsAll()
    {
        $response = $this->json('GET', '/api/streams');

        $stream = Stream::get()->random();

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id'       => $stream->channel_id,
                'game'             => $stream->game,
                'service'          => $stream->service,
                'viewer_count'     => $stream->viewer_count,
                'twitch_stream_id' => $stream->twitch_stream_id,
                'is_current'       => $stream->is_current,
                'sync_time'        => $stream->created_at->toDateTimeString(),
            ]);
    }

    public function testStreamsOneGame()
    {
        $response = $this->json('GET', '/api/streams?games[]='.$this->games[0]->name);

        $stream = Stream::where('game', $this->games[0]->name)->get()->random();

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id'       => $stream->channel_id,
                'game'             => $stream->game,
                'service'          => $stream->service,
                'viewer_count'     => $stream->viewer_count,
                'twitch_stream_id' => $stream->twitch_stream_id,
                'is_current'       => $stream->is_current,
                'sync_time'        => $stream->created_at->toDateTimeString(),
            ]);
    }

    public function testStreamsByDate()
    {
        $stream = Stream::where('is_current', 0)->get()->random();

        $response = $this->json('GET', '/api/streams?dateTo[]='.date('Y-m-d H:i:s', strtotime('yesterday')));

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'channel_id'       => $stream->channel_id,
                'game'             => $stream->game,
                'service'          => $stream->service,
                'viewer_count'     => $stream->viewer_count,
                'twitch_stream_id' => $stream->twitch_stream_id,
                'is_current'       => $stream->is_current,
                'sync_time'        => $stream->created_at->toDateTimeString(),
            ]);
    }
}
