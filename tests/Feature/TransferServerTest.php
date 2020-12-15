<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class TransferServerTest extends TestCase
{


    //test token
//    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTYwMzE5MzM2MCwiZXhwIjoxNjYzMTkzMzAwLCJuYmYiOjE2MDMxOTMzNjAsImp0aSI6IkJ4WUdQb3oyMDRvYXZ5dk0iLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.NN3x3sDQBwQfo3GJFwj5ReJV43XPjF_oL0kM-Sb-G4I';

    // prod token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTYwNDAzMzUyMCwiZXhwIjoxNjY0MDMzNDYwLCJuYmYiOjE2MDQwMzM1MjAsImp0aSI6ImlCRFRsWE0wQWdqWnFJY1QiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.E5VW2i29a6ML94pueunnDBjDXQ-YWFVAK_m8El9U5l8';
    // public  $host = 'http://127.0.0.1:8010';
//   public  $host = 'http://test.sqkdj.com';
  //public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';

  public  $host = 'http://api.sqkdj.com';

   // public  $host = 'http://120.77.46.183:31001';



    public function testGetTransferGoods()
    {
        $loginData = [
//            'coupon_id'=> '9d55d508934e497c87f2d331cf790578 ',
//            'goods_id'=> '564662964930 ',

          //  'coupon_id'=> '35ddc9895224458790484d368df254fe ',
           // 'goods_id'=> '621296131052',//test
            'goods_id'=> '614462280971',
            'is_network_commodity'=> 0 ,
            'type'=> 2,
            'is_debug' => 1
        ];
        print_r(json_encode($loginData));

        $cmd = 'goods/transition/tao';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testTransferOpenGoods()
    {
        $uid = 465539;
        $loginData = [
//            'coupon_id'=> '9d55d508934e497c87f2d331cf790578 ',
//            'goods_id'=> '564662964930 ',

            //  'coupon_id'=> '35ddc9895224458790484d368df254fe ',
            // 'goods_id'=> '621296131052',//test
            'goods_id'=> '614462280971',
            'is_network_commodity'=> 0 ,
            'type'=> 1,
            'muid' => TokenUtils::uid_encrypt($uid),

            //            'is_debug' => 1,
        ];
        print_r(json_encode($loginData));

        $cmd = 'goods/transition/tao';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/open/v1/',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testGetTransferActivity()
    {
        $loginData = [
//            'coupon_id'=> '9d55d508934e497c87f2d331cf790578 ',
//            'goods_id'=> '564662964930 ',

            //  'coupon_id'=> '35ddc9895224458790484d368df254fe ',
            // 'goods_id'=> '621296131052',//test
            'data_id'=> '614462280971',
            'use_method'=> 'company_commission' ,
        ];
        print_r(json_encode($loginData));

        $cmd = 'tao_activity_transfer';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/open/v1/',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testGetJdTransfer()
    {
        $loginData = [
//            'coupon_id'=> '9d55d508934e497c87f2d331cf790578 ',
//            'goods_id'=> '564662964930 ',

              'type'=> 1,
              'goods_id'=> '65725976514',
              'coupon_url'=> 'https://coupon.jd.com/ilink/couponActiveFront/front_index.action?key=5668f43dcc50453db3a01a61ff7bc77c&roleId=35855178&to=mall.jd.com/index-993841.html',
        ];
        print_r(json_encode($loginData));

        $cmd = 'goods/transition/jd';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);

    }


}
