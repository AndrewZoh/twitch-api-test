<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StreamsLiveSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:sync-live';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync live streams';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = [
            'client_id' => config('twitch.client_id'),
        ];
        $twitchApi = new \TwitchApi\TwitchApi($options);

        $games = new \App\Game();
        $games = $games->all()->pluck('name');
        $streams = [];
        foreach ($games as $game) {
            $limit = 100;
            $offset = 0;

            for ($total = 101; $total > $offset; $offset += $limit) {
                try {
                    $stream = $twitchApi->getLiveStreams(null, $game, null, 'live', $limit, $offset);
                    $total = $stream['_total'];
                    $streams = array_merge($stream['streams'], $streams);
                } catch (\Exception $e) {
                    $errorString = 'Error while syncing from '.$offset-$limit.' to '.$offset+$limit;
                    $this->info($errorString);
                    \Log::error($errorString, [$e->getMessage(), $e->getTrace()]);
                }
            }
        }

        \App\Stream::where('is_current', 1)
            ->update(['is_current' => 0]);

        foreach($streams as $stream) {
            \App\Stream::create([
                'game' => $stream['game'],
                'channel_id' => $stream['channel']['_id'],
                'viewer_count' => $stream['viewers'],
                'twitch_stream_id' => $stream['_id'],
                'is_current' => 1,
            ]);
        }

        $this->info('Sync complete!');
        $this->info('Synced '.sizeof($streams).' streams!');

    }
}
