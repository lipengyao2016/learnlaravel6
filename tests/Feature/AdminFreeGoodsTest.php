<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class AdminFreeGoodsTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1NzUzNjQ3NzMsImV4cCI6MTU3NTQ1MTE3MywibmJmIjoxNTc1MzY0NzczLCJqdGkiOiJNM09BRDZMUTZkOUlKOWlrIiwic3ViIjoxMDQsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.OYSU4Wp-UBQZpJqrzGvXMIocm-JZxrHpxqdRRxv3ruQ';

    public  $host = 'http://127.0.0.1:8010';
   //public  $host = 'http://test.sqkdj.com';
  // public  $host = 'http://sj.gateway.com';




    public function testListH5FreeGoods()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 100,
            'target_population' => 2,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/freeGoods',$loginData,0,0,null,null);
    }

    public function testListFreeGoods()
    {
        $loginData = [
            'page_no' =>1,
            'limit' => 10,
           // 'title' =>'儿童',
          //  'data_id' => '600362340666',
           // 'target_population' => 1,
          // 'is_valid' => 0,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/freeGoods',$loginData,0,0,null,null);
    }

    public function testUpdateFreeGoods()
    {
        $loginData = [
            'sort' =>5,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/admin/v1/freeGoods/1442',$loginData,1,0,null,null);
    }

    public function testAddFreeGoods()
    {
       /* $loginData = [
            'data_id' =>'602533899233',
            'free_title' =>'冬季棉拖鞋女包跟情侣家居家室内月子厚底防滑毛绒产后棉拖鞋男冬',
            'coupon' =>0,
            'quanhoujia' =>5.9,
            'free_condition' =>1,
            'free_condition_number' =>3,
            'settlement_method' =>2,
            'target_population' =>2,
            'free_money' =>1,
            'reward_frequency' =>2,
            'sort' =>1,
            'free_price' => 5.9,
            'rate' => 0.0165,
        ];*/

        $loginData = [
            'data_id' =>'607551803900',
            'free_title' =>'白云山星群肌肽原液抗糖化祛黄提亮保湿紧致修护精华液男女正品',
            'coupon' =>5,
            'quanhoujia' =>3.9,
            'free_condition' =>1,
            'free_condition_number' =>3,
            'settlement_method' =>2,
            'target_population' =>2,
            'free_money' =>1,
            'reward_frequency' =>2,
            'sort' =>1,
            'free_price' => 8.9,
            'rate' => 0.6,
        ];

        print_r(json_encode($loginData).PHP_EOL);
        $response = curl($this->host.'/admin/v1/freeGoods',$loginData,1,0,null,null);
    }

    public function testGetGoods()
    {
        $response = curl($this->host.'/admin/v1/freeGoods/1427',[],0,0,null,null);
    }


}
