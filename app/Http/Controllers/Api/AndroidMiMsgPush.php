<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/14
 * Time: 11:57
 */

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Log;
use xmpush\Builder;
use xmpush\HttpBase;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;
use xmpush\Feedback;
use xmpush\DevTools;
use xmpush\Subscription;
use xmpush\TargetedMessage;
use xmpush\Region;

include_once(dirname(__FILE__) . '/autoload.php');

class AndroidMiMsgPush
{
    public static function getSender()
    {
        $secret = 'efLAUMIqkyX9ZtFU5w8/1A==';
        $package = 'com.app.bfb';

        //android 没有测试环境 ，全部在线上环境测试。
       // Constants::useSandbox();
        // 常量设置必须在new Sender()方法之前调用
        Constants::setPackage($package);
        Constants::setSecret($secret);
        $sender = new Sender();
        // $sender->setRegion(Region::China);// 支持海外
        //var_dump($sender);
        return $sender;
    }

    public static function buildMsg($title,$desc,$content,$bPassThrough = false)
    {
        $payload = json_encode($content);
        // message1 演示自定义的点击行为
        $message1 = new Builder();
        if(!$bPassThrough)
        {
            $message1->title($title);  // 通知栏的title
            $message1->description($desc); // 通知栏的descption
            $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
            $message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        }
        $message1->passThrough($bPassThrough ? 1 : 0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->build();
        return $message1;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public static  function msg_push($title,$desc,$content,$type,$bPassThrough ,$target = [])
    {
        Log::debug(__METHOD__.' $type:'.$type.' $target:'.json_encode($target).' $bPassThrough:'.$bPassThrough);
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