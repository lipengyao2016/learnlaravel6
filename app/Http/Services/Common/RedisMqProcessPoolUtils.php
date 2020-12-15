<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/11
 * Time: 10:36
 */

namespace App\Http\Services\Common;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class RedisMqProcessPoolUtils
{
    protected $ctx;
    protected $workCnt;
    protected $pool;
    protected $msgHandleFunc;
    protected $redisMqKey;

    /**
     * ProcessPoolUtils constructor.
     * @param $ctx
     * @param $func
     * @param $workCnt
     */
    public function __construct($ctx, $workCnt,$msgHandleFunc,$redisMqKey)
    {
        $this->ctx = $ctx;
        $this->workCnt = $workCnt;
        $this->msgHandleFunc = $msgHandleFunc;
        $this->redisMqKey = $redisMqKey;
    }

    public function init()
    {
//        $this->pool = $pool = new \Swoole\Process\Pool($this->workCnt,SWOOLE_IPC_MSGQUEUE,$this->msgKey,false);
        $this->pool = $pool = new \Swoole\Process\Pool($this->workCnt);

        $ctx =  $this->ctx;
        $msgHandleFunc = $this->msgHandleFunc;
        $redisMqKey = $this->redisMqKey;
        $this->pool->on("WorkerStart", function ($pool, $workerId) use ($ctx,$msgHandleFunc,$redisMqKey) {
            $process = $pool->getProcess();
            $pid = $process->pid;
            echo "Worker#{$workerId} is started ,pid:$pid\n";

            while (true) {
                $msg = RedisUtils::brpop($redisMqKey,2);
                if ( $msg == null) continue;
                var_dump($msg);
                $bRet = call_user_func_array([$ctx, $msgHandleFunc],[$pid,$msg] );
            }
            echo "Worker#{$workerId} is end\n";
        });

        $this->pool->on("WorkerStop", function ($pool, $workerId) {
            echo "Worker#{$workerId} is stopped\n";
        });

    }

    public function start()
    {
        $this->pool->start();
    }

    public function sendMsg($data)
    {
        RedisUtils::lpush($this->redisMqKey,json_encode($data));
    }
}