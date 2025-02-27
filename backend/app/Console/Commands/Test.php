<?php

namespace App\Console\Commands;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use App\Services\QorDataService;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

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
        $this->info("Hello World!");
        logInfo('just a test');

        return 0;
    }
}
