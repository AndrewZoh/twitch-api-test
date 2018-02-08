<?php

namespace App\Services;

use TwitchApi\TwitchApi;
use App\Game;
use App\Stream;

class StreamService
{
    protected $twitchClient;

    public function __construct()
    {
        $options = [
            'client_id' => config('twitch.client_id'),
        ];
        $this->twitchClient = new TwitchApi($options);
    }

    public function syncLiveStreams()
    {
        $games = Game::all()->pluck('name');
        $streams = [];

        foreach ($games as $game) {
            $limit = 100;
            $offset = 0;
            $total = 0;

            do {
                try {
                    $stream = $this->twitchClient->getLiveStreams(null, $game, null, 'live', $limit, $offset);
                    $total = $stream['_total'];
                    $offset += $limit;
                    $streams = array_merge($stream['streams'], $streams);
                } catch (\Exception $e) {
                    \Log::error('Error while syncing '.$game.' live streams from '.$offset.' to '.($offset+$limit.' of total '.$total), [$e->getMessage(), $e->getTrace()]);
                }
            } while ($offset < $total);
        }

        Stream::where('is_current', 1)
            ->update(['is_current' => 0]);

        foreach($streams as $stream) {
            Stream::create([
                'game' => $stream['game'],
                'channel_id' => $stream['channel']['_id'],
                'viewer_count' => $stream['viewers'],
                'twitch_stream_id' => $stream['_id'],
                'is_current' => 1,
            ]);
        }
    }

}