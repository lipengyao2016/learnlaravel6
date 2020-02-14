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
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODA3MDMxNDgsImV4cCI6MTY0MDcwMzA4OCwibmJmIjoxNTgwNzAzMTQ4LCJqdGkiOiJEZ1RrZlVzd0tiWlRZWWNqIiwic3ViIjoxODE4LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.aR3RbeDFJqmO6YWPzNeQ_7THtUVwshNK6t4_DeXCOgc';

  // public  $host = 'http://127.0.0.1:8050';
 // public  $host = 'http://test.sqkdj.com';
  //  public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';
    public  $host = 'http://api.sqkdj.com';

     public  $appPathPrex = '/app/v1';

     public  $adminPathPrex = '/admin/v1';

     public function makeAppPath()
     {
         return $this->host.$this->appPathPrex;
     }

    public function makeAdminPath()
    {
        return $this->host.$this->adminPathPrex;
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

        $loginData = [
          //  'uid' => 100,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/members/invitation',$loginData,1,0,null,$this->accessToken);

    }

    public function testRegisterUser()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
         //   'code_token' => '634874f0939f697d6ab4c8fe1079e4dc',
            'code' => '224488',
            'type' => 101,
            'mobile' => '13410156512',
            'recommender' => '4pbrjq', //fefe4g
         /*   'third_party_unionid' => '23e2685745254521114',
            'third_party_name' => 'liwang33',
            'avatar' => 'http://www.a.com/a2.jpg',*/
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/auth/register/mobile',($loginData),1);
    }


    public function testBindWxUser()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            'wechat_nick' => 'liwang89',
            'unionid' => '23e2685745254521122',
           // 'avatar' => 'http://www.b.com/c4.jpg',
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
            'mobile' => '13410156612',
           // 'uid' => 101,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/sms/send_code',($loginData),1,0,null,$this->accessToken);
    }

    public function testCheckSmsCode()
    {
        $loginData = [
            'type' => 100,
            'mobile' => '13410156527',
            'code' => '123456',
       /*     'third_party_unionid' => '23e2685745254521114',
            'third_party_name' => 'xiaowang22',
            'avatar' => 'http://www.a.com/a.jpg',*/
           // 'uid' => 101,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/sms/check_code',($loginData),1,
            0,null,$this->accessToken);
    }


    public function testQuickLogin()
    {
        $loginData = [
            'third_party_unionid' => '23e2685745254521120',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/auth/login/quick',($loginData),1);
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
        $response = curl($this->makeAppPath().'/members/info/isNewUser',$loginData,1,0,null, $this->accessToken);
    }

}
