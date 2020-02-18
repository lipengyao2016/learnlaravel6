<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/14
 * Time: 15:41
 */

namespace App\Http\Controllers\Api;


class MiMsgPushService
{
    public static  function msg_push($platform,$title,$desc,$content,$type,$bPassThrough,$target = [])
    {
        $ret = [];
        switch ($platform)
        {
            case MiPushConstant::$platform_android:
                $ret = AndroidMiMsgPush::msg_push($title,$desc,$content,$type,$bPassThrough,$target);
                break;
            case MiPushConstant::$platform_ios:
                $ret = IosMiMsgPush::msg_push($title,$desc,$content,$type,$bPassThrough,$target);
                break;
            default:
                $ret = ['code' => -100 ,'msgh' => 'unsupport platform type'.$platform ];
                break;

        }
        return $ret;

    }
}