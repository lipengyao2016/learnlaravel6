<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class GoodsServerTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODA3MDMxNDgsImV4cCI6MTY0MDcwMzA4OCwibmJmIjoxNTgwNzAzMTQ4LCJqdGkiOiJEZ1RrZlVzd0tiWlRZWWNqIiwic3ViIjoxODE4LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.aR3RbeDFJqmO6YWPzNeQ_7THtUVwshNK6t4_DeXCOgc';

   public  $host = 'http://127.0.0.1:8010';
  //public  $host = 'http://test.sqkdj.com';
  // public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';

 // public  $host = 'http://api.sqkdj.com';

   // public  $host = 'http://120.77.46.183:31001';


    public function testGetCategory()
    {
        $loginData = [
            'plate' => 'jd',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/category/filter',$loginData,1,0,null,null);
    }

    public function testSyncCategory()
    {
        $loginData = [
            'platform' => 'pdd',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/category/syncPddCategory',$loginData,1);
    }

    public function testImportJDJfGoods()
    {
        $loginData = [
        'pageCount' => 1,
        'platformType'=> 'cheap_mail',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/jdGoodsImport',$loginData,1);
    }

    public function testImportPddGoods()
    {
        $loginData = [
            'pageCount' => 1,
            'platformType'=> 'high_commission',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/pddGoodsImport',$loginData,1);
    }

    public function testImportDtkGoods()
    {
        $loginData = [
            'pageCount' => 1,
            'platformType'=> 'hot_push',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/dtkGoodsImport',$loginData,1);
    }

    public function testSearchLocalGoods()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 10,
           //  'title' =>'法国原装进口 布瑞弗尼4段儿童配方牛奶200ml*6支*2 盒',
            'plate' => 'quan',
          //  'cid' => 10022,
         /*   'order_by' => 'sort',  //sell,price
            'sort_by' => 'desc',*/
           'item_source'=>1,
           // 'price_zone_type' => 2,
           // 'has_coupon' => 'true',
            //'user_defined' =>3425,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/local_goods',$loginData,0,0,null,$this->accessToken);
    }

    public function testGetGoodsDetails()
    {
        $loginData = [
            'goods_id' => '607365558342',//
          //  'is_network_commodity'=>1,
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/detail',$loginData,0,0,null,$this->accessToken);
    }

    public function testSearchOnlineGoods()
    {
        $loginData = [
            'has_coupon' => 'true',
            'page_no'=>1,
          // 'keyword'=>'https://item.taobao.com/item.htm?id=521182368686',
           // 'keyword'=>'keyword=【】https://m.tb.cn/h.3qQQxl1?sm=1a2abb 点击链接，再选择浏览器咑閞；或復·制这段描述￥Z2BCboEUxqn￥后到淘♂寳♀　　',
            'keyword'=>'丹麦蓝罐曲奇饼干908g礼盒装皇室牛油风味办公休闲早餐零食年货',
            'source'=>3,
            'sort'=>'sales_asc',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/search',$loginData,0,0,null,$this->accessToken);
    }


    public function testGetGoodsDetailsImg()
    {
        $loginData = [
            'goods_id' => '59295417032',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/detail/img',$loginData,0,0,null,$this->accessToken);
    }

    public function testGetRecommendGoods()
    {
        $loginData = [
            'goods_id' => '520224267132',
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/relation',$loginData,0,0,null,$this->accessToken);
    }

    public function testGetGoodsHitInfo()
    {
        $loginData = [
            'item_source' => 1,
            'commission_rate' => 0.19,
            'goods_id' => '610200494103',
            'use_coupon_price' => 103,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/hint_info',$loginData,0,0,null,$this->accessToken);
    }

    public function testImportJdChannelGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importJdChannelGoods',$loginData,1);
    }


    public function testImportTbChannelGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importTbChannelGoods',$loginData,1);
    }

    public function testImportPddChannelGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importPddChannelGoods',$loginData,1);
    }

    public function testUpdateLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateLocalGoods',$loginData,1);
    }

    public function testUpdateOneGoods()
    {
        $loginData = [
            'goods_id' => '590084304040',
            'item_source' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateOneGoods',$loginData,1);
    }

    public function testGetGoodsCategory()
    {
        $loginData = [
            'data_id' => '560032139535',
            'item_source' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/category',$loginData,1);
    }



    public function testGetGoodsTkl()
    {
        $loginData = [
            'goods_id' => '560032139535'
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/tkl',$loginData,1);
    }



    public function testUpdateGoodsItemSource()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateGoodsItemSource',$loginData,1);
    }

    public function testImportTbLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importTbLocalGoods',$loginData,1);
    }

    public function testImportJdLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importJdLocalGoods',$loginData,1);
    }

    public function testImportPddLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importPddLocalGoods',$loginData,1);
    }

    public function testUpdateTbLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateTbLocalGoods',$loginData,1);
    }

    public function testUpdateJdLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateJdLocalGoods',$loginData,1);
    }

    public function testUpdatePddLocalGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updatePddLocalGoods',$loginData,1);
    }

    public function testUpdateTbNewestGoods()
    {
        $loginData = [
            'updateType' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/updateTbNewestGoods',$loginData,1);
    }

    public function testImportRecommendGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/importRecommendGoods',$loginData,1);
    }

    public function testGetActivityGoods()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/goods/getActivityGoods',$loginData,1);
    }
}
