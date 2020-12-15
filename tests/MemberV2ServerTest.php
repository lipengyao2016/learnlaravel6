<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class MemberV2ServerTest extends TestCase
{
    //test token
   public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODY0MjUzODQsImV4cCI6MTY0NjQyNTMyNCwibmJmIjoxNTg2NDI1Mzg0LCJqdGkiOiJDUTM3T2E5NUhsYXN4aUFEIiwic3ViIjo4NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.ySvN0AplkIYtKyzRBxU4AHsJuRkXYEp3CHGRMpzVmrA';

    //prod token
   //public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTU4MzEzNDkzMSwiZXhwIjoxNjQzMTM0ODcxLCJuYmYiOjE1ODMxMzQ5MzEsImp0aSI6IloxekJOTWxtY09FV2d2WVAiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.66HbGbXNShrxWPASAZvYDvKbseekcXFkiVLwDBk8UCA';

 // public  $host = 'http://127.0.0.1:8050';
    public  $host = 'http://test.sqkdj.com';
  //  public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';
 // public  $host = 'http://api.sqkdj.com';

     public  $appPathPrex = '/app/v2';

     public  $adminPathPrex = '/admin/v1';

    public  $openPathPrex = '/open/v1';

     public function makeAppPath($bVer = null)
     {
         if($bVer)
         {
             return $this->host.'/app/v'.$bVer;
         }
         else
         {
             return $this->host.$this->appPathPrex;
         }

     }

    public function makeAdminPath()
    {
        return $this->host.$this->adminPathPrex;
    }

    public function makeOpenPath()
    {
        return $this->host.$this->openPathPrex;
    }


    public function testBindH5Mobile()
    {
        print_r(urldecode('%E4%B8%89%E9%87%8C%E6%B8%85%E9%A3%8E'));
        //return;
        /*  print_r(parserCode('5uu6sd'));
          return;*/
        $loginData = [
            'mobile' => '13410156610',
            'type' => 103,
            'code' => '258369',
            'third_party_unionid' => '23e2685745254522210',
            'third_party_name' => '%E4%B8%89%E9%87%8C%E6%B8%85%E9%A3%8E',
            'avatar' => 'http://www.b3.com/b3.jpg',
        ];
        print_r(json_encode($loginData));
        // $response = curl($this->makeAppPath().'/auth/register/mobile',($loginData),1);

        $cmd = 'auth/register/binding/mobile';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/open/v1/',$loginData,$cmd,$method,$this->accessToken);
    }



    public function testRegisterAppUser()
    {

        /*  print_r(parserCode('5uu6sd'));
          return;*/
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            //   'code_token' => 'c2b92743f04f001b0ae3b73ba2dc0b52',
            'code' => '258369',
            'type' => 101,
            'mobile' => '13410156610',
            'recommender' => '6Q5C4F', //fefe4g
               'third_party_unionid' => '23e26857452545211122',
               'third_party_name' => 'liwang33',
               'avatar' => 'http://www.a.com/a2.jpg',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v2/auth/register/mobile',($loginData),1);
    }

    public function testRegisterOpenUser()
    {

        /*  print_r(parserCode('5uu6sd'));
          return;*/
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            //   'code_token' => 'c2b92743f04f001b0ae3b73ba2dc0b52',
            'code' => '258369',
            'type' => 101,
            'mobile' => '13410156610',
            'recommender' => '6Q4EPT', //fefe4g
            'third_party_unionid' => 'o-iJa1oFuG4R2DOApZv1wCcizk2210',
            'third_party_name' => '%E4%B8%89%E9%87%8C%E6%B8%85%E9%A3%8E',
            'avatar' => 'http://thirdwx.qlogo.cn/mmopen/vi_32/82O1aZoZiaiblYNQdJicfa4gNbq1G3k4FKxyWNGiaOn4YcutVoN5qvv0e1vnXblRfibPhgOPe6TkgWBFPgiagMEmNmAw/132',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/auth/register/mobile',($loginData),1);
    }



    public function testBindWxUser()
    {
        $loginData = [
            //"has_coupon"=>true,
            // 'fields' => 'head_img,nick,wechat_nick_name,mobile',
            'wechat_nick' => 'liwang33',
            'unionid' => '23e2685745254521142',
            'avatar' => 'http://www.b.com/t1.jpg',
            'code_token' => 'd5d06a469af4ca5208df0bce482ecdf4',
            //  'uid' => 105,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath(1).'/members/info/wechat/bind',($loginData),1,0,null,
            $this->accessToken);
    }

    public function testSendSms()
    {
        $loginData = [
            'type' => 207,
            'mobile' => '13410156527',
          //  'check' => 1,
           // 'third_party_unionid' => '23e2685745254521135',
           // 'uid' => 101,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->makeAppPath().'/sms/send_code',($loginData),1,0,null,$this->accessToken);
    }

    public function testCheckSmsCode()
    {
        $loginData = [
            'type' => 207,
            'mobile' => '13410156527',
           // 'code' => '258369',  //
            'code' => '542349',  //
           // 'third_party_unionid' => '23e2685745254521135',
           // 'third_party_name' => 'xiaowang88',
           // 'avatar' => 'http://www.e.com/e.jpg',
           // 'recommender' => '6Q5C4F', //fefe4g
            //'uid' => 101,
        ];
        print_r(json_encode($loginData));
       // $response = curl($this->makeAppPath().'/sms/check_code',($loginData),1, 0,null,$this->accessToken);

        $cmd = 'sms/check_code';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v2/',$loginData,$cmd,$method,$this->accessToken);
    }


    public function testQuickLogin()
    {
        $loginData = [
           // 'third_party_unionid' => '23e2685745254521114',
            'third_party_unionid' => '23e2685745254521135',

        ];
        print_r(json_encode($loginData));
      //  $response = curl($this->makeAppPath().'/auth/login/quick',($loginData),1);
        $cmd = 'auth/login/quick';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }



    public function testCheckWxStatus()
    {
        $loginData = [
            // 'third_party_unionid' => '23e2685745254521114',
            'third_party_unionid' => 'o-iJa1oFuG4R2DOApZv1wCcizkPc',

        ];
        print_r(json_encode($loginData));
        //  $response = curl($this->makeAppPath().'/auth/login/quick',($loginData),1);
        $cmd = 'auth/wx/reg/status';
        $method = 'post';
        $response =AikAppReq::sendReq($this->host.'/open/v1/',$loginData,$cmd,$method,$this->accessToken);
    }






}
