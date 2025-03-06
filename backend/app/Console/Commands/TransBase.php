<?php

namespace App\Console\Commands;

use App\Services\TransService;
use Illuminate\Console\Command;
use Throwable;

class TransBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '翻译后台管理的内容，包括合作伙伴和帮助中心';

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
        printf("do translate:base\n");
        try {
            TransService::transHelps();
            TransService::transPartners();
        } catch (Throwable $e) {
            logException($e);
            printf("has error:%s\n", $e->getMessage());
            return 1;
        }
        return 0;
    }
}
