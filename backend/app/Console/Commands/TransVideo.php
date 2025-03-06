<?php

namespace App\Console\Commands;

use App\Services\TransService;
use Illuminate\Console\Command;
use Throwable;

class TransVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        printf("do translate:video\n");
        try {
            TransService::transVideos();
        } catch (Throwable $e) {
            logException($e);
            printf("has error:%s\n", $e->getMessage());
            return 1;
        }
        return 0;
    }
}
