<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/12
 * Time: 9:49
 */

namespace Tests\Feature;

class TokenUtils
{
    public  static  function uid_encrypt($uid)
    {
        $appkey = ['5#cUs$Hwf&0&slVwzj','zpbzZz!go2*x^rL^ZH5^hRSW5CtW'];//前后秘钥串
        $pattr = [0=>'#', 1=>'x', 2=>'G', 3=>'%', 4=>'q', 5=>'M', 6=>'!', 7=>'t', 8=>'5', 9=>'l'];//加密字典
        $uid = $uid + 178178;//数值增加
        $uid = str_pad($uid,10,"0",STR_PAD_LEFT);//生成10位数，不足前面补0
        $uid = strrev($uid);//将数字翻转
        $uids = str_split((string)$uid);//数值转数组

        $res = '';
        foreach ($uids as $v){
            $res .= $pattr[$v];//转换成字符串
        }
        $res = $appkey[0].$res.$appkey[1];//拼接前后的秘钥串
        return bin2hex($res);

    }
    static function uid_decrypt($token)
    {
        $appkey = ['5#cUs$Hwf&0&slVwzj','zpbzZz!go2*x^rL^ZH5^hRSW5CtW'];
        $pattr = ['#'=>'0', 'x'=>'1', 'G'=>'2', '%'=>'3', 'q'=>'4', 'M'=>'5', '!'=>'6', 't'=>'7', '5'=>'8', 'l'=>'9'];
        $token= self::hexXbin($token);
        $token = str_replace($appkey,'',$token);
        $uids = str_split((string)$token);
        $res = '';
        foreach ($uids as $v){
            $res .= $pattr[$v];
        }
        $uid = strrev($res);
        $uid = preg_replace('/^0+/','',$uid);//str_pad($uid,10,"0",STR_PAD_LEFT);
        $uid = $uid - 178178;
        return $uid;
    }
    static  function hexXbin($data, $types = false){
        if(!is_string($data))
            return 0;
        if($types === false){
            $len = strlen($data);
            if ($len % 2) {
                return 0;
            }else if (strspn($data, '0123456789abcdefABCDEF') != $len) {
                return 0;
            }
            return pack('H*', $data);
        }else{
            return bin2hex($data);
        }
    }
}