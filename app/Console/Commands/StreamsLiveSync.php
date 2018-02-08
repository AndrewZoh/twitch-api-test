<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StreamService;

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

    protected $streamService;

    public function __construct(StreamService $streamService)
    {
        parent::__construct();

        $this->streamService = $streamService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Sync started');
        $this->streamService->syncLiveStreams();
        $this->info('Sync completed');
    }
}
