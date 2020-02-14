<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class AdminCustomerBannersTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1NzUzNjQ3NzMsImV4cCI6MTU3NTQ1MTE3MywibmJmIjoxNTc1MzY0NzczLCJqdGkiOiJNM09BRDZMUTZkOUlKOWlrIiwic3ViIjoxMDQsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.OYSU4Wp-UBQZpJqrzGvXMIocm-JZxrHpxqdRRxv3ruQ';

    public  $host = 'http://127.0.0.1:8010';
   //public  $host = 'http://test.sqkdj.com';
   //public  $host = 'http://sj.gateway.com';


    public function testListCustomerBanners()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 1,
            'title' =>'测试',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/customer_banners',$loginData,0,0,null,null);
    }

    public function testUpdateCustomerBanners()
    {
        $loginData = [
            'img' =>'http://avatar.xfz178.com/1122',
            'image_width' => 750,
            'image_height' => 280,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/customer_banners/3428',$loginData,1,0,null,null);
    }

    public function testAddCustomerBanners()
    {
        $loginData = [
            'title' =>'测试销量',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/customer_banners',$loginData,1,0,null,null);
    }

    public function testGetCustomerBanners()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/customer_banners/3428',$loginData,0,0,null,null);
    }

    public function testAddCustomerBannerGoods()
    {
        $goodsItemStr = '{"catid":18,"data_id":60069199666,"img":"http:\/\/img14.360buyimg.com\/ads\/jfs\/t1\/55978\/39\/6043\/38753\/5d3a77e5E9e33e090\/382f2dc62fb24247.jpg","price":320,"title":"\u6e05\u6ee2\u67d4\u80a4\u6c34400ml\uff08\u5927\u7c89\u6c34\uff09\u8865\u6c34 \u4fdd\u6e7f \u723d\u80a4\u6c34","url":"http:\/\/item.jd.com\/60069199666.html","commission":224,"sort":0,"addtime":1575439146,"volume":892,"is_recommend":0,"is_del":0,"item_source":2,"item_description":"","commission_rate":0.7,"coupon_url":"\/\/coupon.jd.com\/ilink\/couponSendFront\/send_index.action?key=321463c9b4e7432d95f42bb92f915b16&roleId=24352486&to=mall.jd.com\/index-598130.html","use_coupon_price":70,"pingou_price":0,"promotion_start_time":1575439146,"promotion_end_time":1576043946,"section":"high_commission","coupon_start_time":1571932800000,"coupon_end_time":1577807999000,"coupon_price":250,"price_zone_type":0,"shop_id":605640,"shop_name":0,"free_shipping":0,"owner":0,"is_hot":1,"goodComments":96,"is_has_coupon":1}';
        $goodsItem = json_decode($goodsItemStr,true);
        $goodsItem['bankuai'] = 3425;
        $response = curl($this->host.'/admin/v1/goods',$goodsItem,1,0,null,null);
    }


    public function testListCustomerBannerGoods()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 10,
            'bankuai' => 3352,
           // 'cid' => 20,
          //  'item_source'=>2,
           // 'data_id' => '45031781719',
          //  'title' =>'澳大利亚原瓶进口',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/goods',$loginData,0,0,null,null);
    }





}
