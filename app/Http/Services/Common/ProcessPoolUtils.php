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


class ProcessPoolUtils
{
    protected $ctx;
    protected $func;
    protected $workCnt;
    protected $pool;
    protected $msgKey;
    protected $msgHandleFunc;

    /**
     * ProcessPoolUtils constructor.
     * @param $ctx
     * @param $func
     * @param $workCnt
     */
    public function __construct($ctx, $func, $workCnt,$msgKey,$msgHandleFunc)
    {
        $this->ctx = $ctx;
        $this->func = $func;
        $this->workCnt = $workCnt;
        $this->msgKey = $msgKey;
        $this->msgHandleFunc = $msgHandleFunc;
    }

    public function init()
    {
//        $this->pool = $pool = new \Swoole\Process\Pool($this->workCnt,SWOOLE_IPC_MSGQUEUE,$this->msgKey,false);
        $this->pool = $pool = new \Swoole\Process\Pool($this->workCnt,SWOOLE_IPC_SOCKET);

        $ctx =  $this->ctx;
        $func = $this->func;
        $this->pool->on("WorkerStart", function ($pool, $workerId) use ($ctx,$func) {
            $process = $pool->getProcess();
            $pid = $process->pid;
            echo "Worker#{$workerId} is started ,pid:$pid\n";
//            $bRet = call_user_func_array([$ctx, $func],[$workerId] );


            echo "Worker#{$workerId} is end\n";
        });

        $msgHandleFunc = $this->msgHandleFunc;
        $this->pool->on("Message", function ($pool, $message) use ($ctx,$msgHandleFunc)  {
            $process = $pool->getProcess();
            $pid = $process->pid;
            echo "Worker# pid :$pid  got msg:$message .\n";
            $bRet = call_user_func_array([$ctx, $msgHandleFunc],[$pid,$message] );
        });

        $this->pool->on("WorkerStop", function ($pool, $workerId) {
            echo "Worker#{$workerId} is stopped\n";
        });

        $this->pool->listen('127.0.0.1', 8089);

    }

    public function start()
    {
        $this->pool->start();
    }

    public function wait()
    {
        while ($ret = \swoole_process::wait()) {
            $pid = $ret['pid'];
            echo "process {$pid} existed\n";
        }
    }


    public function sendMsg($data)
    {
//        $q = \msg_get_queue($this->msgKey);
//        return \msg_send($q, 1, $data, false);

        $fp = stream_socket_client("tcp://127.0.0.1:8089", $errno, $errstr) or die("error: $errstr\n");
        $msg = json_encode($data);
        fwrite($fp, pack('N', strlen($msg)).$msg);
        fclose($fp);
    }
}