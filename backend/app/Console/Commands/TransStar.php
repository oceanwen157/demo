<?php

namespace App\Console\Commands;

use App\Services\TransService;
use Illuminate\Console\Command;
use Throwable;

class TransStar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:star';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将抓取的数据进行多语言翻译-明星';

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
        printf("do translate:star\n");
        try {
            TransService::transPstars();
        } catch (Throwable $e) {
            logException($e);
            printf("has error:%s\n", $e->getMessage());
            return 1;
        }
        return 0;
    }
}
