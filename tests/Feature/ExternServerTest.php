<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class ExternServerTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1Nzc5MzIzNTUsImV4cCI6MTYzNzkzMjI5NSwibmJmIjoxNTc3OTMyMzU1LCJqdGkiOiJIdkZpWUhoV0R6Wmh6cGdXIiwic3ViIjo4NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.XjLbAWsLeQSJJETVY0Z8W0WgzbCU_ttFwI4uY7l7hcc';

   // public  $host = 'http://127.0.0.1:8060';
  //  public  $host = 'http://test.sqkdj.com';
   // public  $host = 'http://sj.gateway.com';

    public  $host = 'http://api.sqkdj.com';

    // public  $host = 'http://120.77.46.183:31001';
     public  $appPathPrex = '/open/v1';

     public  $adminPathPrex = '/admin/v1';

     public function makeAppPath()
     {
         return $this->host.$this->appPathPrex;
     }

    public function makeAdminPath()
    {
        return $this->host.$this->adminPathPrex;
    }


    public function testSendSms()
    {
        $loginData = [
            'mobile' => '13410156527',
            'type' => 100,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.$this->appPathPrex.'/sms/send_code',$loginData,1);
    }





}
