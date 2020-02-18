<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/2/14
 * Time: 15:41
 */

namespace App\Http\Controllers\Api;


class MiPushConstant
{
    public static $push_mode_alias = 'alias_push';
    public static $push_mode_topic = 'topic_push';
    public static $push_mode_all = 'all_push';

    public static $platform_android = 'android';
    public static $platform_ios = 'ios';
}