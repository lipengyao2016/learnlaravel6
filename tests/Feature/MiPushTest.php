<?php

namespace Tests\Feature;

use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class MiPushTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0NzFkM2I3MTQzY2VmYWFiYTM2ODI5MzAwZWI4M2M5MDk3NjEyZTMwYmYxYjQ5ZjhiZGZiM2UxZTNkY2U3NDU5M2EyOTJiZDUyNWJhYmEyIn0.eyJhdWQiOiIyIiwianRpIjoiMjQ3MWQzYjcxNDNjZWZhYWJhMzY4MjkzMDBlYjgzYzkwOTc2MTJlMzBiZjFiNDlmOGJkZmIzZTFlM2RjZTc0NTkzYTI5MmJkNTI1YmFiYTIiLCJpYXQiOjE1NjkyMjMyOTYsIm5iZiI6MTU2OTIyMzI5NiwiZXhwIjoxNTcwNTE5Mjk2LCJzdWIiOiIxMCIsInNjb3BlcyI6W119.MTcMh8tH9cAWW--yyFVBYDQ5j1GEODMA32RXK2cpMp8phbKiRRviPleTpJMFi1xVEOtxI4n1vx3MF7WJqXMVswmCNUzjSoYronJeCa3Csvo17itrwzhHjU2wN-yRRLHRoJOm2BPDeVFRIYUN0DzGKxUwqAFJJnNDyk8yV2TRyYhS5nKi0BsxnWUtn7DuZT4ei5W2pYVjfxdVi-Znh7BBUim16ipGQdmjWxzytJBEzuLz_6j8ixptkO3-uYFEUywV5hCaxVIa1GMVPJyEqbaUMpG3pcvnCqR3_qbuiGsv5yLMT_Py7OzpR7htFPh_4HJxDfPV_WPx2_y0V-zdZ1Hq-BpcaEEnmp22TQGOx9BNq_qHCtsiiZB9gH8fT7NAyJlvPPlWmuWGKmbAWjJUIjvnfr3DqkymDtggbOzw8z_vU0GW-J3Eybjznw5dhpd-IEtnzuk6K5cKGiROwtgh2CgqUjKk0N08ZWT4IyFBNjxI7kDdF1s_bjaFznidFE_baMjkTo7XVBn4_c-KaR1sl7fg-WaOCXlZqS3YmRxo_HlEFj6WpRw3b2Dyv9D9DpsMuAvVjlDMIOjMkMuSZ6FFxx6cMh_o8p2YSjx5u2ael1UMO8TkwrXJhK9XLjzGBhZTSJXFdxaaPOyDfH00G8xFSwz_QgdJ81aC0mxPzEW3jSbY4yE';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAndroidMsgPush()
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$this->accessToken,

        ];
        $data = [
           'title' => 'test',
           'desc' => 'akb android msg push 11',
           'content' => [
               'name' => 'ih xx 77',
               'sec' => 'manxx'
           ],
//           'type' => 'alias_push',
//            'uid' => [ '519406'],

           'type' => 'topic_push',
            'uid' => 'jx_information',

          /*  'type' => 'all_push',
            */

            'platform' => 'android',
            'bPassThrough' => 0,
        ];
        $response = $this->post('api/mi_msg_push',$data,$headers);
        var_dump(json_decode($response->getContent(),true));
        $response->assertStatus(200);
    }



    public function testIosMsgPush()
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$this->accessToken,

        ];
       /* $data = [
            'uid' => [/*'alias1', 'alias2',*/  /*'6682981'],
            'title' => 'test',
            'desc' => 'akb test env ios msg push 33',
            'content' => [
                'name' => 'ih',
                'sec' => 'woman'
            ],
        ];
        $response = $this->post('api/ios_msg_push',$data,$headers);*/

        $data = [
            'title' => 'test',
            'desc' => 'akb ios msg push 99',
            'content' => [
                'name' => 'ih xx 99',
                'sec' => 'manxx'
            ],
          /*  'type' => 'alias_push',
            'uid' => [ '6682981'],*/

                 'type' => 'topic_push',
                  'uid' => 'jx_information',

             // 'type' => 'all_push',

            'platform' => 'ios',
            'bPassThrough' => 0,
        ];
        $response = $this->post('api/mi_msg_push',$data,$headers);

        var_dump(json_decode($response->getContent(),true));
        $response->assertStatus(200);
    }



    public function testAllMsgPush()
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$this->accessToken,

        ];
        $data = [
            'uid' => ['alias1', 'alias2'],
            'title' => 'test',
            'desc' => 'akb all os msg push',
            'content' => [
                'name' => 'lily',
                'sec' => 'woman'
            ],
        ];
        $response = $this->post('api/all_msg_push',$data,$headers);
        print_r($response->getContent());
        $response->assertStatus(200);
    }


}
