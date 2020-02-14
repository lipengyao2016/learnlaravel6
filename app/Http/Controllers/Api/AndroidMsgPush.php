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

class AndroidMsgPush
{
    public static function getSender()
    {
        $secret = 'efLAUMIqkyX9ZtFU5w8/1A==';
        $package = 'com.app.bfb';
        // 常量设置必须在new Sender()方法之前调用
        Constants::setPackage($package);
        Constants::setSecret($secret);
        $sender = new Sender();
        // $sender->setRegion(Region::China);// 支持海外
        //var_dump($sender);
        return $sender;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public static  function alias_push($aliasList,$title,$desc,$content)
    {
        Log::debug(__METHOD__.' $aliasList:'.json_encode($aliasList));
        $sender = self::getSender();

        $payload = json_encode($content);
        // message1 演示自定义的点击行为
        $message1 = new Builder();
        $message1->title($title);  // 通知栏的title
        $message1->description($desc); // 通知栏的descption
        $message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message1->build();

        Log::debug(' message fields:'.json_encode($message1->getFields()). ' extra info:'.json_encode($message1->getJSONInfos()));
        $sendRet = $sender->sendToAliases($message1, $aliasList);
        Log::debug(' errorCode :' . $sendRet->getErrorCode().PHP_EOL);
        Log::debug($sendRet->getRaw());
        return $sendRet->getRaw();
    }


}