<?php

namespace Tests\Feature;

use App\Stream;

class StreamsTest extends ApiTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStreamsSuccess()
    {
        $response = $this->json('GET', '/api/streams');

        $stream = Stream::take(20)->get()->random();

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
