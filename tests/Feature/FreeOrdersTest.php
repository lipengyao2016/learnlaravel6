<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class FreeOrdersTest extends TestCase
{
    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1NzY1NDY5NDgsImV4cCI6MTYzNjU0Njg4OCwibmJmIjoxNTc2NTQ2OTQ4LCJqdGkiOiJRVGN6Y1k2U2VhRUM2bENDIiwic3ViIjo4NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Ltcsj70q7HkvWRq3EObmttIZJqiOEWhOTK6SuAw5n1Y';

    public  $host = 'http://127.0.0.1:8010';
  // public  $host = 'http://test.sqkdj.com';
  // public  $host = 'http://sj.gateway.com';



    public function testImportFreeGoodsOrder()
    {
        $freeGoodsOrderStr = '{
	"id": 9907,
	"add_time": "2019-12-13 20:13:08",
	"click_time": "2019-09-01 10:52:28",
	"create_time": "2019-12-10 14:04:46",
	"pay_time": null,
	"self_settle_time": "2019-12-13 20:13:08",
	"item_title": "适用福特14经典福克斯雨刮器06老07原装09年11款12新13胶条雨刷片",
	"item_iid": 595658903834,
	"item_num": 1,
	"shop_title": "创艺星旗舰店",
	"seller_nick": "创艺星旗舰店",
	"pay_price": 168,
	"real_pay_fee": 68,
	"commission_rate": 0.015,
	"commission": 0.93,
	"uid": 77,
	"uid_string": "77-0-0-0-73-74--80--",
	"trade_id": "603017281909336482",
	"trade_id_former": "603017281908336482",
	"qrsj": 0,
	"app_key": 0,
	"cid": 0,
	"category_name": "汽车零部件/养护/美容/维保",
	"platform": 0,
	"status": 0,
	"adzone_name": "0元购活动",
	"buy_type": "fx",
	"buy_way": "u672au77e5",
	"goods_thumbnail_url": "https://img.alicdn.com/bao/uploaded/i1/2201217154506/O1CN01vophNm1j9nDzPiPAB_!!2201217154506.jpg",
	"special_id": null,
	"relation_id": "2134359567",
	"acc_name": "tb594949609",
	"update_time": "2019-12-13 20:13:08",
	"user_level": 1,
	"order_type": "天猫"
} ';
        $loginData = json_decode($freeGoodsOrderStr,true);
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/importFreeGoodsOrder',$loginData,0,0,null,null);
    }

    public function testClaimFreeGoodsOrder()
    {
        $loginData = [
            'trade_id' => '603017281908336481',
           // 'uid'=>85,
        ];
        print_r(json_encode($loginData));

        $response = curl($this->host.'/app/v1/claimTrade',$loginData,0,0,null,$this->accessToken);
    }

    public function testUpdateFreeGoodsOrder()
    {
        $freeGoodsOrderStr = '{
	"id": 9907,
	"add_time": "2019-12-13 20:13:08",
	"click_time": "2019-09-01 10:52:28",
	"create_time": "2019-12-10 14:04:46",
	"pay_time": "2019-12-15 14:04:46",
	"self_settle_time": "2019-12-13 20:13:08",
	"item_title": "适用福特14经典福克斯雨刮器06老07原装09年11款12新13胶条雨刷片",
	"item_iid": 595658903834,
	"item_num": 1,
	"shop_title": "创艺星旗舰店",
	"seller_nick": "创艺星旗舰店",
	"pay_price": 168,
	"real_pay_fee": 68,
	"commission_rate": 0.015,
	"commission": 0.93,
	"uid": 77,
	"uid_string": "77-0-0-0-73-74--80--",
	"trade_id": "603017281909336482",
	"trade_id_former": "603017281908336482",
	"qrsj": 0,
	"app_key": 0,
	"cid": 0,
	"category_name": "汽车零部件/养护/美容/维保",
	"platform": 0,
	"status": 3,
	"adzone_name": "0元购活动",
	"buy_type": "fx",
	"buy_way": "u672au77e5",
	"goods_thumbnail_url": "https://img.alicdn.com/bao/uploaded/i1/2201217154506/O1CN01vophNm1j9nDzPiPAB_!!2201217154506.jpg",
	"special_id": null,
	"relation_id": "2134359567",
	"acc_name": "tb594949609",
	"update_time": "2019-12-13 20:13:08",
	"user_level": 1,
	"order_type": "天猫"
} ';
        $loginData = json_decode($freeGoodsOrderStr,true);
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/updateFreeGoodsOrder',$loginData,0,0,null,$this->accessToken);
    }

    public function testListFreeGoodsOrder()
    {
        $loginData = [
         //   'uid'=>85,
        ];
        print_r(json_encode($loginData));

        $response = curl($this->host.'/app/v1/freeGoodsOrder',$loginData,0,0,null,$this->accessToken);
    }

    public function testListAdminFreeOrder()
    {
        $loginData = [
           // 'create_time'=>'',
          //  'settle_time'=>'',
           //'if_ok' => 1,
            //'num_iid' => '608204593207',
        ];
        print_r(json_encode($loginData));

        var_dump($loginData);

        $response = curl($this->host.'/admin/v1/freeGoodsOrder',$loginData,0,0,null,$this->accessToken);
    }

}
