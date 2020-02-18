<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/14
 * Time: 11:57
 */

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Log;
use xmpush\IOSBuilder;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;
use xmpush\Region;

include_once(dirname(__FILE__) . '/autoload.php');


class IosMiMsgPush
{
    public static function getSender()
    {
        $secret = '1D0q8aQjLJap7pY4CbV35g==';
        $bundleId = 'com.dxkj.xgp';

        //ios 有测试环境。
        Constants::useSandbox();

        Constants::setBundleId($bundleId);
        Constants::setSecret($secret);
        $sender = new Sender();
        // $sender->setRegion(Region::China);// 支持海外
        //var_dump($sender);
        return $sender;
    }

    public static function buildMsg($title,$desc,$content,$bPassThrough = false)
    {
        $content['time'] = time();
        $payload = json_encode($content);
       // $payload = ($content);

        $message = new IOSBuilder();
     /*   $message->description($desc);
        $message->soundUrl('default');
        $message->badge('4');*/
        $message->title($title);
        $message->body($desc);
        $message->extra('payload', $payload);
        $message->build();
        return $message;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public static  function msg_push($title,$desc,$content,$type,$bPassThrough,$target = [])
    {
        Log::debug(__METHOD__.' $type:'.$type.' $target:'.json_encode($target));
        $sender = self::getSender();
        $message = self::buildMsg($title,$desc,$content,$bPassThrough);
        Log::debug(__METHOD__.' message fields:'.json_encode($message->getFields()). ' extra info:'.json_encode($message->getJSONInfos()));
        $sendRet = [];
        switch ($type)
        {
            case MiPushConstant::$push_mode_alias:
                $sendRet = $sender->sendToAliases($message, $target);
                break;
            case MiPushConstant::$push_mode_topic:
                $sendRet = $sender->broadcast($message, $target);
                break;
            case MiPushConstant::$push_mode_all:
                $sendRet = $sender->broadcastAll($message);
                break;
            default:
                return ['code' => -1,'msg' => ' not support current push mode'];
                break;
        }

        Log::debug(__METHOD__.' errorCode :' . $sendRet->getErrorCode().PHP_EOL);
        Log::debug(__METHOD__.' raw:'.json_encode($sendRet->getRaw()));

        return ['code' => $sendRet->getErrorCode() ,'data' => $sendRet->getRaw() ];
    }


}