<?php

namespace App\Console\Commands;

use App\Common\kafka\Consumer;
use App\Common\kafka\HighConsumer;
use App\Common\kafka\LowerConsumer;
use Illuminate\Console\Command;

class ConsumeKafka extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consume';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $offset = 0; //开始消费点
        //$consumer = new LowerConsumer(['ip'=>'47.107.246.243']);
        $consumer = new LowerConsumer(['ip'=>'47.112.111.193']);
        $consumer->setConsumerGroup('TransferGroup')
            ->setBrokerServer('47.112.111.193')
            ->setConsumerTopic()
            ->setTopic('transfer', 0, $offset)
            ->subscribe(['transfer'])
            ->consumer(function($msg){
                print_r($msg);
            });

    }
}
