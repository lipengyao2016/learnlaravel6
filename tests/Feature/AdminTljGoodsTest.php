<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class AdminTljGoodsTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1Nzc2OTU1MDgsImV4cCI6MTYzNzY5NTQ0OCwibmJmIjoxNTc3Njk1NTA4LCJqdGkiOiJ2UjF1OEZMSEx2bHpvaXdOIiwic3ViIjo4NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.rpBm-8ToXVB8bGojbn_8QctAOudOn7Akd9_CQ4GeBII';

  // public  $host = 'http://127.0.0.1:8010';
  // public  $host = 'http://test.sqkdj.com';
  // public  $host = 'http://sj.gateway.com';

    public  $host = 'http://api.sqkdj.com';

    public function testAddTljGoods()
    {
        $loginData = [
            'data_id' =>'603649193754',
            'free_title' =>'果仁奶脆糖糖果结婚喜糖散装发批硬糖怀旧小零食小吃网红休闲食品cc',
            'target_population' =>2,
            'total_num' =>5,
            'send_start_time' =>'2020-04-10 08:52:08',
            'send_end_time' =>'2020-04-29 10:00:08',
     /*       'send_start_time' =>1577203200,
            'send_end_time' =>1577289600,*/
            'per_face' =>1,
            'name' =>'淘礼金红',
            'campaign_type' => 'MKT',
            'tlj_img' => '',
            'coupon' =>10,
            'quanhoujia' =>68,
            'rate' => 0.02,
            'free_price' => 70,
            'user_total_win_num_limit' =>1,
            'platform' => 1,
        ];
        print_r(json_encode($loginData).PHP_EOL);
        $response = curl($this->host.'/admin/v1/tljGoods',$loginData,1,0,null,null);
    }

    public function testListTljGoods()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 10,
          // 'free_title' =>'儿单',
           // 'data_id' => '595658903834',
           // 'send_start_time' => '2019-12-17 10:59:08',
           // 'send_end_time' =>'2019-12-22 10:00:08',
           // 'platform' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/tljGoods',$loginData,0,0,null,null);
    }



    public function testListAppTljGoods()
    {
        $loginData = [
            // 'free_title' =>'儿单',
            //'target_population' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/tljGoods',$loginData,0,0,null,$this->accessToken);
    }

    public function testGetUnVisibleAppTljGoods()
    {
        $loginData = [
            // 'free_title' =>'儿单',
            'target_population' => 2,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/getUnVisibleTljGoods',$loginData,0,0,null,null);
    }

    public function testBatchUpdateTljGoods()
    {
        $loginData = [
                 'id' => 1457,
                 'sort' => 13,
               //  'is_visible' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/modifyTljGoodsSort',$loginData,1,0,null,null);
    }

    public function testBuyTljGoods()
    {
        $loginData = [
                'id' => 6604,
                'uid' => 85,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/buyTljGoods',$loginData,1,0,null,$this->accessToken);
    }



    public function testUpdateTljOrder()
    {
        $loginData = [
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/updateTljOrder',$loginData,1,0,null,$this->accessToken);
    }

    public function testListTljOrder()
    {
        $loginData = [
           // 'data_id' => '595658903834',
            'kl' => '￥F3g91ZeBeZO￥',
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/tlj_report',$loginData,1,0,null,$this->accessToken);
    }

    public function testChange_shelf_status()
    {
        $loginData = [
            'id' => 1563,
            'is_visible' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/tljGoods/change_shelf_status',$loginData,1,0,null,null);
    }

    public function testEsSSearch()
    {
        $searchStr = '{
  "query": {
    "match": {
      "title":  "玩具"
    }
  }
}';
        $searchQS = json_decode($searchStr,true);
        print_r(json_encode($searchQS));
        $response = curl('http://47.112.236.104:9200/akb_goods/_search',$searchQS,0,0,null,null);
    }

}
