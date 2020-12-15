<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class TP6_UserServerTest extends TestCase
{
    //test token
  // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODMxMzMzMTMsImV4cCI6MTY0MzEzMzI1MywibmJmIjoxNTgzMTMzMzEzLCJqdGkiOiJoT2MzdzNMVkptMXNvUk9KIiwic3ViIjoxODE5LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.K1WsUdIaN0BNSvQYBeIBxcF-K5zhxqn_bhRM55XMuqs';

    //prod token
   public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTU4MzEzNDkzMSwiZXhwIjoxNjQzMTM0ODcxLCJuYmYiOjE1ODMxMzQ5MzEsImp0aSI6IloxekJOTWxtY09FV2d2WVAiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.66HbGbXNShrxWPASAZvYDvKbseekcXFkiVLwDBk8UCA';

   public  $host = 'http://www.tp5.com';

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


    public function testCreateUser()
    {
        $curTime = date('Y-m-d H:i:s');
        $loginData = [
            "age" =>     21,
		"password"=>  "123456",
		"name"=>     "caocao22",
		"create_at"=>  $curTime,
		"update_at"=> $curTime,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/user',$loginData,1);
    }

    public function testBatchCreateUser()
    {
        $curTime = date('Y-m-d H:i:s');
        $loginData = [
            "age" =>     21,
            "password"=>  "123456",
            "name"=>     "chuntian",
            "create_at"=>  $curTime,
            "update_at"=> $curTime,
        ];
        $userList = [];
        for ($i =0;$i < 10 ;$i++)
        {
            $loginData['name'] = "chuntian_$i";
            $userList[] = $loginData;
        }
        print_r(json_encode($loginData));
        $response = curl($this->host.'/user/batchCreate',$userList,1);
    }


    public function testUpdateUser()
    {
        $curTime = date('Y-m-d H:i:s');
        $loginData = [
            "age" =>     50,
            "password"=>  "233",
            "name"=>     "ttttt",
            "create_at"=>  $curTime,
            "update_at"=> $curTime,
        ];
        print_r(json_encode($loginData));
        $headers = array(
            "Content-type:application/json;charset=utf-8"
        );
        $response = curl_v2($this->host.'/user/721',$headers,$loginData,'put');
    }

    public function testCreateRecvBank()
    {
        $curTime = date('Y-m-d H:i:s');
        $ShopRecvBankData = [
            'shop_id' =>11,
            'recv_name' =>'王六cc',
            'recv_card_no' =>'694234453646213541636',
            'recv_bank_name' =>'中国工商银行宝安支行ff',
        ];
        $headers = array(
            "Content-type:application/json;charset=utf-8"
        );
        $response = curl_v2('http://api.youfun.shop//api/shopRecvBanks',$headers,$ShopRecvBankData,'post');
        var_dump($response);
    }


}
