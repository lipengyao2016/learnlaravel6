<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class MemberServerTest extends TestCase
{
    //test token
  // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODMxMzMzMTMsImV4cCI6MTY0MzEzMzI1MywibmJmIjoxNTgzMTMzMzEzLCJqdGkiOiJoT2MzdzNMVkptMXNvUk9KIiwic3ViIjoxODE5LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.K1WsUdIaN0BNSvQYBeIBxcF-K5zhxqn_bhRM55XMuqs';

    //prod token
   public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTU4MzEzNDkzMSwiZXhwIjoxNjQzMTM0ODcxLCJuYmYiOjE1ODMxMzQ5MzEsImp0aSI6IloxekJOTWxtY09FV2d2WVAiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.66HbGbXNShrxWPASAZvYDvKbseekcXFkiVLwDBk8UCA';

  //public  $host = 'http://127.0.0.1:8050';
//    public  $host = 'http://test.sqkdj.com';
   // public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';
      public  $host = 'http://api.sqkdj.com';

      public  $appPathPrex = '/app/v1';

      public  $adminPathPrex = '/admin/v1';

      public  $openPathPrex = '/open/v1';

     public function makeAppPath()
     {
         return $this->host.$this->appPathPrex;
     }

    public function makeAdminPath()
    {
        return $this->host.$this->adminPathPrex;
    }

    public function makeOpenPath()
    {
        return $this->host.$this->openPathPrex;
    }


    public function testAdminLogin()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            //   'code_token' => '634874f0939f697d6ab4c8fe1079e4dc',
            'name' => '郭峰',
            'password' => 'gf@123',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/login',$loginData,1);
    }




    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMemberInvite()
    {
    /*    $loginData = [
            'uid' => 27,
        ];
        print_r(json_encode($loginData));
        //$response = curl('http://127.0.0.1:8050/members/invitation',json_encode($loginData),1);
        $response = curl('http://test.sqkdj.com/app/v1/members/invitation',json_encode($loginData),1);
        assert($response != null);*/

   /* print_r(getUidCode(402495));
    return;*/

        /*  $memberData = [
              'mobile' => '18998033802',
              'code' => '890123',
          ];
          print_r(json_encode($memberData));
          return;*/

        $loginData = [
         //  'uid' => 1,
        ];
        print_r(json_encode($loginData));
       // $response = curl($this->makeAppPath().'/members/invitation',$loginData,1,0,null,$this->accessToken);

        $cmd = 'members/invitation';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testRegisterUser()
    {

      /*  print_r(parserCode('5uu6sd'));
        return;*/
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            'code_token' => '27ea31706954f2e46af203df9874fcad',
           // 'code' => '258369',
            'type' => 101,
            'recommender' => '6Q5C4F', //fefe4g

            'mobile' => '13410156527',
            'third_party_unionid' => '23e2685745254521126',

            'third_party_name' => 'liwang66',
            'avatar' => 'http://www.c.com/c2.jpg',
        ];
        print_r(json_encode($loginData));
       // $response = curl($this->makeAppPath().'/auth/register/mobile',($loginData),1);

        $cmd = 'auth/register/mobile';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }



    public function testBindMobile()
    {
        /*  print_r(parserCode('5uu6sd'));
          return;*/
        $loginData = [
            'mobile' => '13410156527',
            'third_party_unionid' => '23e2685745254521126',
            'third_party_name' => 'liwang55',
            'avatar' => 'http://www.b.com/b2.jpg',
        ];
        print_r(json_encode($loginData));
        // $response = curl($this->makeAppPath().'/auth/register/mobile',($loginData),1);

        $cmd = 'auth/register/binding/mobile';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }


    public function testRegisterOpenUser()
    {

        /*  print_r(parserCode('5uu6sd'));
          return;*/
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
               'code_token' => 'c2b92743f04f001b0ae3b73ba2dc0b52',
           // 'code' => '258258',
            'type' => 101,
            'mobile' => '13410156584',
            'recommender' => '6Q5C4F', //fefe4g
               'third_party_unionid' => '23e26857452545211121',
               'third_party_name' => 'liwang33',
               'avatar' => 'http://www.a.com/a2.jpg',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/auth/register/mobile',($loginData),1);
    }



    public function testBindWxUser()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            'wechat_nick' => 'liwang89',
            'unionid' => '23e2685745254521112',
            'avatar' => 'http://www.b.com/c4.jpg',
          //  'uid' => 105,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info/wechat/bind',($loginData),1,0,null,
            $this->accessToken);
    }

    public function testSendSms()
    {
        $loginData = [
            'type' => 101,
            'mobile' => '13410156527',
            'check' => 0
           // 'uid' => 101,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeOpenPath().'/sms/send_code',($loginData),1,0,null,$this->accessToken);
    }

    public function testCheckSmsCode()
    {
        $loginData = [
            'type' => 100,
            'mobile' => '18076758305',
            'code' => '258369',  //
//            'third_party_unionid' => '23e2685745254521120',
//            'third_party_name' => 'xiaowang55',
//            'avatar' => 'http://www.b.com/b.jpg',
           // 'uid' => 101,
        ];
        print_r(json_encode($loginData));
       // $response = curl($this->makeAppPath().'/sms/check_code',($loginData),1, 0,null,$this->accessToken);

        $cmd = 'sms/check_code';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }


    public function testQuickLogin()
    {
        $loginData = [
           // 'third_party_unionid' => '23e2685745254521114',
            'third_party_unionid' => 'o-iJa1twPpa3TlPBIq_XGwPwOVGY',

        ];
        print_r(json_encode($loginData));
      //  $response = curl($this->makeAppPath().'/auth/login/quick',($loginData),1);
        $cmd = 'auth/login/quick';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }


    public function testMemberInfo()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
 /*           'wechat_nick' => 'lihua',
            'unionid' => '23463265350',*/
            //  'uid' => 105,
            'fields' => 'head_img,nick,wechat_nick_name,mobile,id,username,is_valid'
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info',($loginData),0,0,null,
            $this->accessToken);
    }

    public function testMemberRoleInfo()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
              'uid' => 105,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info/use_role',$loginData,1,0,null,
            $this->accessToken);
    }

    public function testMemberInner_users()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
            'uid' => 85,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info/inner_users',$loginData,1,0,null,
            $this->accessToken);
    }




    public function testRoleInfo()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
            'level' => 1,

        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info/role',$loginData,1,0,null,
            $this->accessToken);
    }

    public function testTimes()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
           // 'level' => 1,

        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/time/open_app',$loginData,1,0,null,
            $this->accessToken);
    }



    public function testGoodsConvert()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
            //  'uid' => 105,
            'goods_id'=> '598580444245',
            'type'=> 2,
            'client'=> 'App',
            'uid'=> 3,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/goods/transition/tao',$loginData,0,0,null,
            $this->accessToken);
    }

    public function testOrder1()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
            //  'uid' => 105,
       /*     'goods_id'=> '598580444245',
            'type'=> 2,
            'client'=> 'App',
            'uid'=> 3,*/
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/v1/orders/search',$loginData,0,0,null,
            $this->accessToken);
    }


    public function testZcfAppLogs()
    {
        $data = [
            'code' => 30001,
            'source' => 'ap',
            'params' => 'sdgs',
            'message' => 'tiang1',
        ];
        $url = 'http://localhost:8085/beesgarden/app/log/logMsg';
        var_dump($url);
//执行请求获取数据

        try {
            $ret = curl($url, $data, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }

    public function testMember_checkIsNewUser()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            /*           'wechat_nick' => 'lihua',
                       'unionid' => '23463265350',*/
            'uid' => 85,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeOpenPath().'/members/info/isNewUser',$loginData,1,0,null, $this->accessToken);
    }

    public function testValidUser()
    {
        $loginStr = '
        {
	"pay_price": 68,
	"item_iid": 543405404720,
	"item_title": "\u563b\u87ba\u4f1a\u67f3\u5dde\u6b63\u5b97\u87ba\u86f3\u7c89\u5e7f\u897f\u7279\u4ea7\u87ba\u72ee\u7c895\u5305\u90ae\u87ba\u4e1d\u7c89\u901f\u98df\u7c73\u7ebf\u9178\u8fa3\u7c89",
	"shop_title": "\u563b\u87ba\u4f1a\u98df\u54c1\u65d7\u8230\u5e97",
	"seller_nick": "\u563b\u87ba\u4f1a\u98df\u54c1\u65d7\u8230\u5e97",
	"real_pay_fee": 24.9,
	"commission_rate": 2,
	"commission": 0.441,
	"item_num": 1,
	"trade_id": 854487808740430868,
	"trade_id_former": 854487808740430868,
	"category_name": "\u7cae\u6cb9\u7c73\u9762\/\u5357\u5317\u5e72\u8d27\/\u8c03\u5473\u54c1",
	"platform": "\u65e0\u7ebf",
	"acc_name": "feelsin",
	"create_time": "2020-02-20 10:57:20",
	"click_time": "2020-02-20 10:56:57",
	"adzone_name": "wz-ela3439",
	"special_id": "2382812750",
	"relation_id": "2382812751",
	"order_type": "\u805a\u5212\u7b97",
	"status": 0,
	"cid": "",
	"buy_type": "zg",
	"buy_way": "\u672a\u77e5",
	"uid": 465539,
	"uid_string": "465727-0-0-0-0-461456-0-0-0-0",
	"user_level": 0,
	"add_time": "2020-02-20 10:58:00",
	"update_time": "2020-02-20 10:58:00",
	"id": "76066"
}';
        $loginData = json_decode($loginStr,true);
        var_dump(($loginData));
        $response = curl($this->host.'/open/v1/valid_user',$loginData,1,0,null, $this->accessToken);
    }

    public function testMember_syncAllUserNickFromWx()
    {
        $loginData = [
            'uid' => 85,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/info/syncAllUserNickFromWx',$loginData,1,0,null, $this->accessToken);
    }



}
