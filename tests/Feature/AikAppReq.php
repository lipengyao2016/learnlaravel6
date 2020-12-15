<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/11
 * Time: 11:27
 */

namespace Tests\Feature;


use SebastianBergmann\CodeCoverage\Report\PHP;

class AikAppReq
{

    //客户端生成签名测试
    public static  function sign($cmd,$method){
        //以下参数缺一不可
        $data = [
            'appkey' => 'NTMCWMseNSvBGnR85eYpLFB',//服务端发的秘钥
            'type'   => 'android',//设备类型 安卓'android' 苹果'ios'
            'timestamp' => time(),//Unix时间戳
            'uuid'   => 'xfz178178',//设备唯一标识
            'path'   => $cmd,//请求相对url 例如完整路径是http://other.xiaofei178.net/app/v1/article_types 则只需要‘v1/’之后的部分
            'method'   => $method,//请求方法（如get、post、delete等）
        ];

        $data_sort = $data;//赋给临时数组
        sort($data_sort,SORT_STRING);//对数组进行字典排序
        $data['sign'] = implode($data_sort);//拼接数组 得到：1540380482NTMCWMseNSvBGnR85eYpLFBandroidarticle_typesgetxfz178178
        print_r('sign:'.$data['sign']);
        $data['sign'] = $data['sign'].$data['appkey'];//再次拼接秘钥：1540380482NTMCWMseNSvBGnR85eYpLFBandroidarticle_typesgetxfz178178NTMCWMseNSvBGnR85eYpLFB
        $data['sign'] = md5($data['sign']);//32位md5加密：1078e9377c0f6309ec6d011e61756c86
        $data['sign'] = strtolower($data['sign']);//转小写：1078e9377c0f6309ec6d011e61756c86
        unset($data['appkey']);//从数组中移除appkey
        $scode = json_encode($data);//转json字符串:{"type":"android","timestamp":1540380992,"uuid":"xfz178178","path":"article_types","method":"get","sign":"39f827fb8896d500d1eec5eac74df4f9"}
        print_r(' json scode:'.$scode);
        $scode = base64_encode($scode);//转base_64编码得到签名：eyJ0eXBlIjoiYW5kcm9pZCIsInRpbWVzdGFtcCI6MTU0MDM4MTAxMCwidXVpZCI6InhmejE3ODE3OCIsInBhdGgiOiJhcnRpY2xlX3R5cGVzIiwibWV0aG9kIjoiZ2V0Iiwic2lnbiI6IjQ3MWU3ZDhhNzRlNDQ1YjUxNGE1ZjM4YzczOWE5NmRjIn0=
        print_r(' base64 code:'.$scode);

        return $scode;
    }

    public static  function sendReq($rootUrl,$paramData,$cmd,$method,$userToken = null,$bNeedSign = true){
       // print_r(json_encode($paramData));
        $headers =  array(
            "Content-type:application/json;charset=utf-8",
            'Accept:application/json',
           // 'ApiToken:'.$sign,
            "user-agent:shengjian|868243039108516|ANDROID|offical|4.0|219"
          //  'User-Agent:aikbao|865166024723960|Android|official|1.8.0|6177508|49997460|oppo|oppo a33|5.1.1'
        );

        if($bNeedSign)
        {
            $sign = AikAppReq::sign($cmd,$method);
            $paramData['path'] = $cmd;
            $paramData['method'] = $method;
            array_push($headers,  'ApiToken:' . $sign);
        }

        if($userToken)
        {
            array_push($headers,  'Authorization:' . 'Bearer '.$userToken);
        }


        var_dump($headers);


        if(strcasecmp($method,'post') == 0)
        {
            $paramData = json_encode($paramData);
        }
        print_r(__METHOD__.json_encode($paramData).PHP_EOL);
        $response =UrlUtils::curl(($rootUrl.$cmd),$headers,$paramData,$method == 'post');
       // print_r(__METHOD__.$response.PHP_EOL);
        var_dump(json_decode($response,true));
        return $response;
    }



}