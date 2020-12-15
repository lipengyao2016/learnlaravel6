<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class DtkTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1NzQzMDc1NDksImV4cCI6MTU3NDM5Mzk0OSwibmJmIjoxNTc0MzA3NTQ5LCJqdGkiOiJlNjU5U3BDQUhBdDBqNUJpIiwic3ViIjoxMDQsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.drEil0y5cJu-1HbALNyUNJmx532qNZ_dzM8e9VVzsPQ';

   // public  $host = 'http://test.sqkdj.com';
    public  $host = 'http://sj.gateway.com';

     public  $appPathPrex = '/app/v1';

     public  $adminPathPrex = '/admin/v1';

     public function makeAppPath()
     {
         return $this->host.$this->appPathPrex;
     }

    public function makeAdminPath()
    {
        return $this->host.$this->adminPathPrex;
    }


    function makeSign($data, $appSecret)
    {
        ksort($data);
        $str = '';
        foreach ($data as $k => $v) {

            $str .= '&' . $k . '=' . $v;
        }
        $str = trim($str, '&');
        $sign = strtoupper(md5($str . '&key=' . $appSecret));
        return $sign;
    }

    public function testGetCategory()
    {
        //接口地址
        $host = 'https://openapi.dataoke.com/api/category/get-super-category';
        $appKey = '5dce80145a2f9';//应用的key
        $appSecret = '2ea5c916eb5997df14d602eb3f8b223e';//应用的Secret
//默认必传参数
        $data = [
            'appKey' => $appKey,
            'version' => 'v1.1.0',
        ];
//加密的参数
        $data['sign'] = $this->makeSign($data,$appSecret);
//拼接请求地址
        $url = $host .'?'. http_build_query($data);
        var_dump($url);
//执行请求获取数据

        try {
            $ret = curl($url, [], $data, 0, 1);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }



    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMemberInvite()
    {
        $data = [
            'code' => 30001,
            'source' => 'ap',
            'params' => 'sdgs',
            'message' => 'tiang1',
        ];
        $url = 'http://localhost:8085/beesgarden/app/log/logMsg';
        var_dump($url);
//执行请求获取数据

        try {
            $ret = curl($url, $data, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);

    }

    public function testGetProductList()
    {
        $data = [
            'pageIndex' => 1,
            'pageSize' => 20,
            'staus' => 1
        ];
        $url = 'http://203.195.164.19:8080/product/list';
        var_dump($url);
//执行请求获取数据

        try {
            $ret = curl($url, $data, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);

    }

    public function testCreateTcCustomer()
    {
        $data = [
            'name' =>'xiaowangx',
            'mobile' =>'13410987657',
            'type' =>'1,2,3',
        ];
        $url = 'http://api.youfun.shop/api/tc_customers';
        try {
            $ret = curl($url, $data, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }

    public function testCreateTcCompany()
    {
        $data = [
            'contact_name' =>'杨总99',
            'name' =>'深圳市约范信息有限公司33',
            'phone' =>'13410987654',
            'province'=> '广东省',
            'city'=> '深圳市',
            'district'=> '宝安区',
            'address'=> '创业一路31号33',
            'openid' => 'xxx'
        ];
        $url = 'http://api.youfun.shop/api/tc_companies';
        try {
            $ret = curl($url, $data, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }

    public function testGetTcCompany()
    {
        $data = [

        ];
        $url = 'http://api.youfun.shop/api/tc_companies';
        try {
            $ret = curl($url, $data, 0, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }


    public function testCreateTcCompanyContactLog()
    {
        $TcCompanyContactLogData = [
            'company_id' =>1,
            'operator_id' =>30,
            'is_jietong' =>1,
            'remark' => 'ttt2'
        ];
        $url = 'http://api.youfun.shop/api/tc_company_contact_log';
        try {
            $ret = curl($url, $TcCompanyContactLogData, 1, 0, null,null);
        } catch (Exception $e) {
        }
        var_dump($ret);
    }






}
