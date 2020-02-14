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


class IosMsgPush
{
    public static function getSender()
    {
        $secret = '1D0q8aQjLJap7pY4CbV35g==';
        $bundleId = 'com.dxkj.xgp';

        Constants::setBundleId($bundleId);
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

        $message = new IOSBuilder();
        $message->description($desc);
        $message->soundUrl('default');
        $message->badge('4');
        $message->extra('payload', $payload);
        $message->build();


        print_r(' message fields:'.json_encode($message->getFields()). ' extra info:'.json_encode($message->getJSONInfos()));
        $sendRet = $sender->sendToAliases($message, $aliasList);
        print_r(' errorCode :' . $sendRet->getErrorCode().PHP_EOL);
        print_r($sendRet->getRaw());
        return $sendRet->getRaw();
    }


}