<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class InvitePlayBillServerTest extends TestCase
{
    //test token
   public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODMxMzMzMTMsImV4cCI6MTY0MzEzMzI1MywibmJmIjoxNTgzMTMzMzEzLCJqdGkiOiJoT2MzdzNMVkptMXNvUk9KIiwic3ViIjoxODE5LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.K1WsUdIaN0BNSvQYBeIBxcF-K5zhxqn_bhRM55XMuqs';

    //prod token
   //public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC91c2VyXC90b2tlbiIsImlhdCI6MTU4MzEzNDkzMSwiZXhwIjoxNjQzMTM0ODcxLCJuYmYiOjE1ODMxMzQ5MzEsImp0aSI6IloxekJOTWxtY09FV2d2WVAiLCJzdWIiOjQ2NTUzOSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.66HbGbXNShrxWPASAZvYDvKbseekcXFkiVLwDBk8UCA';

 // public  $host = 'http://127.0.0.1:8050';
    public  $host = 'http://test.sqkdj.com';
   // public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';
 // public  $host = 'http://api.sqkdj.com';

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


    public function testCreateInvitePlayBill()
    {
        $loginData = [
            'img_url' => 'http://youquanimg.sqkdj.net/2020021700512499739',
            'operator' => 'xiaowang1',
            'sort' => 5,
            'publish_time' => '2020-04-21 12:00:00',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/invite_play_bill',$loginData,1);
    }

    public function testUpdateInvitePlayBill()
    {
        $loginData = [
            'img_url' => 'http://www.f.jpg',
            'sort' => 7,
            'publish_time' => '2020-04-10 12:00:00',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/invite_play_bill/6',$loginData,1);
    }

    public function testChangePublishStatus()
    {
        $loginData = [
            'id' => 7,
            'to_publish' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/invite_play_bill/change_publish_status',$loginData,1);
    }

    public function testListInvitePlayBill()
    {
        $loginData = [
            'page_no' => 1,
            'limit' => 1,
            'publish_status' => 1,
            'publish_begin_time' => '2020-04-10 12:00:00',
            'publish_end_time' => '2020-04-12 17:00:00',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/invite_play_bill',$loginData,0);
    }

    public function testCheckAllPublishStatus()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/checkAllPublishStatus',$loginData,0);
    }



}
