<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class Go_UserServerTest extends TestCase
{
    //test token
  // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODMxMzMzMTMsImV4cCI6MTY0MzEzMzI1MywibmJmIjoxNTgzMTMzMzEzLCJqdGkiOiJoT2MzdzNMVkptMXNvUk9KIiwic3ViIjoxODE5LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.K1WsUdIaN0BNSvQYBeIBxcF-K5zhxqn_bhRM55XMuqs';

    //prod token
   public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTU4MzEzNDkzMSwiZXhwIjoxNjQzMTM0ODcxLCJuYmYiOjE1ODMxMzQ5MzEsImp0aSI6IloxekJOTWxtY09FV2d2WVAiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.66HbGbXNShrxWPASAZvYDvKbseekcXFkiVLwDBk8UCA';

   public  $host = 'http://127.0.0.1:8081';

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
            "Age" =>     21,
		"Password"=>  "123456",
		"Name"=>     "caocao22",
		"Create_at"=>  $curTime,
		"Update_at"=> $curTime,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/v1/user',$loginData,1);
    }

    public function testBatchCreateMsg()
    {
        $curTime = date('Y-m-d H:i:s');
        $msgList = [];
        for($i = 0;$i < 100;$i++)
        {
            $loginData = [
                "Content" =>' goods msg_' .$i,
            ];
            $msgList[] = $loginData;
        }

        $response = curl($this->host.'/app/v3/msg_orm/batch_create?token=34',['Data'=>$msgList],1);
    }


    public function testListMsg()
    {
        $loginData = [
            //"Content" =>' goods msg_' .$i,
           // "id__in" => '[194,195]',
           // "content__contains" => "goods",
           // "content__icontains"=> "Goods",
            "create_at__gte"=> "2020-08-06 11:13:42",
            "create_at__lte"=> "2020-08-06 11:13:45",
            "token"=>34,
            "page_size" => 10,
            "page_no" => 5
        ];

        $response = curl($this->host.'/app/v3/msg_orm',$loginData,0);
    }

    public function testUpdateMsg()
    {
        $loginData = [
            "content" => "qinhuaxx msg",
        ];

        $response = curl($this->host.'/app/v3/msg_orm/186?token=34',$loginData,1);
    }

    public function testGetTransferInfo()
    {
        $loginData = [
            //"Content" =>' goods msg_' .$i,
            // "id__in" => '[194,195]',
            // "content__contains" => "goods",
            // "content__icontains"=> "Goods",
            "uid"=> 11706825,
            "token"=>34,
        ];

        $response = curl($this->host.'/app/v3/transfer/info2',$loginData,0);
    }



}
