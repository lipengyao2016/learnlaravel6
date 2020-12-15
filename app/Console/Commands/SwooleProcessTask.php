<?php

namespace App\Console\Commands;

use App\Repositories\SwooleTaskRepositoryEloquent;
use Illuminate\Console\Command;

class SwooleProcessTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole_task:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run swoole_task';

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
    public function handle(SwooleTaskRepositoryEloquent $repositoryEloquent)
    {
        //
        //设置永久执行
        ignore_user_abort();
        ini_set("max_execution_time", "120");
        set_time_limit(0);
        error_reporting(0);
        ini_set("display_errors ","Off");
        ini_set('memory_limit', '5000M');

        $repositoryEloquent->run();
    }
}
