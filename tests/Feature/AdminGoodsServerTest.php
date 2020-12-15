<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class AdminGoodsServerTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3FrZGouY29tXC9hZG1pblwvbG9naW4iLCJpYXQiOjE1ODA3MTk3MjMsImV4cCI6MTY0MDcxOTY2MywibmJmIjoxNTgwNzE5NzIzLCJqdGkiOiI0SnpEM0xFb0tjRFZxTFZMIiwic3ViIjo2LCJwcnYiOiJjZjI4NGMyYjFlMDZmMzNjMjZiZDU3OTc1NjZkOWZkNzRiZTExYmY1In0.75KRpbyenq_gtYFXWhwTcgvd81IwtAIyjE5LQKvdg1Q';

  //public  $host = 'http://127.0.0.1:8010';
    //public  $host = 'http://test.sqkdj.com';
  // public  $host = 'http://sj.gateway.com';

    public  $host = 'http://api.sqkdj.com';

    public function testGetCategory()
    {
        $loginData = [
            'item_source' => 3,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/category',$loginData,0,0,null,null);
    }

    public function testGetSection()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/section',$loginData,0,0,null,null);
    }


    public function testListGoods()
    {
        $loginData = [
            'page_no' =>2,
            'limit' => 10,
           // 'plate' => 'high_commission',
          //  'cid' => 0,
          //  'item_source'=>1,
         //  'data_id' => '29082313233',
          //  'title' =>'帽子',
            'bankuai' => 3510,


  /*          'page_no'=>1,
            'plate'=>'',
            'limit'=>20,
            'cid'=>0,
            'item_source'=>'',
            'data_id'=>1,

            'title'=>'',*/
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/goods',$loginData,0,0,null,null);
    }

    public function testUpdateGoods()
    {
        $loginData = [
            'priority' =>8,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/goods/314818',$loginData,1,0,null,null);
    }

    public function testAddGoods()
    {

        $goodsManUpdate = [
              'title' => 1,
              'promotion_start_time' => 0,
              'promotion_end_time' => 0,
              'coupon_start_time' => 0,
              'coupon_end_time'=> 0,
              'coupon_id'=> 1,
              'coupon_url'=> 1,
        ];
        print_r(json_encode($goodsManUpdate));

        $goodsItem = [
	"commission_rate"=> "0.099",
	"commission"=> "0.97",
	"item_source"=> 1,
	"data_id"=> "607773140159",
	"price"=> "19.8",
	"title"=> "安徽江米条老式传统手工果子雪花条糯米条京果炒糖小麻花特产零食xx",
	"shop_name"=> "富泰食品专营店",
	"sale_volume_label"=> "月销2709件",
	"volume"=>2709,
	"is_tmall"=> 1,
	"img"=> "https://img.alicdn.com/bao/uploaded/i3/2200773078601/O1CN0179C8O62DPJ8KtJO0X_!!0-item_pic.jpg",
	"coupon_url"=> "https://uland.taobao.com/quan/detail?sellerId=2200773078601&activityId=1ca3cae256464382a02618380efd6dcd",
	"coupon_price"=> "10",
	"coupon_available_time"=> "12月21日-12月25日",
	"use_coupon_price"=> "9.8",
	"pingou_price"=> "0",
	"goods_banners"=> "[\"https://img.alicdn.com/i2/2200773078601/O1CN01Opy1wg2DPJ8MleVl0_!!2200773078601.jpg\",\"https://img.alicdn.com/i4/2200773078601/O1CN01E7bVsx2DPJ8EzZStd_!!2200773078601.jpg\",\"https://img.alicdn.com/i2/2200773078601/O1CN01KUszi42DPJ8Mlf330_!!2200773078601.jpg\",\"https://img.alicdn.com/i4/2200773078601/O1CN01xXzoes2DPJ8U5WnT5_!!2200773078601.jpg\"]",
	"item_description"=> "采选优质天然小麦粉为原材料，传统手工制作，外层白糖包裹，口感酥松劲脆，色泽鲜香诱人，满满健康味道，休闲时刻来一下，补充能量小能手！",
	"is_network_commodity"=> true,
	"descScore"=> 4.8,
	"shipScore"=> 4.8,
	"serviceScore"=> 4.8,
	"coupon_start_time"=> "2019-12-21 00=>00=>00",
	"coupon_end_time"=> "2019-12-25 00=>00=>00",
	"url"=> "https://item.taobao.com/item.htm?id=607773140159",
	"promotion_start_time"=> 1577178496,
	"promotion_end_time"=> 1577783296,
	"is_man_update"=>'{"title":1,"promotion_start_time":0,"promotion_end_time":0,"coupon_start_time":0,"coupon_end_time":0,"coupon_id":1,"coupon_url":1}'
];
        var_dump($goodsItem);
        $response = curl($this->host.'/admin/v1/goods',$goodsItem,1,0,null,null);
    }

    public function testAddGoodsByDataId()
    {
        $loginData = [
            'data_id' => '100005167987',
            'item_source'=>'2',
            'bankuai' => 3506,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/addGoodsByDataId',$loginData,1,0,null,$this->accessToken);
    }


    public function testGetGoodsDetails()
    {
        $loginData = [
            'goods_id' => '586918483878',
          //  'is_network_commodity'=>1,
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/goods_detail',$loginData,0,0,null,$this->accessToken);
    }

    public function testTopGoods()
    {
        $loginData = [
            'to_top' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/topGoods/45241',$loginData,1,0,null,$this->accessToken);
    }

    public function testGetGoods()
    {
        $response = curl($this->host.'/admin/v1/goods/314625',[],0,0,null,null);
    }


}
