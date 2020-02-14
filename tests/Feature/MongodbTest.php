<?php

namespace Tests\Feature;

use App\Common\kafka\Consumer;
use App\Common\kafka\Producer;
use App\Common\mongodb\MongoDbDao;
use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class AppLoginTest extends TestCase
{
    //user token
   // public $accessToken  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY1ZWQwODhmZTlmY2ZmMTAyNDY0MjRiNzcwN2Y1M2RiNTE1OTdjMTQ1OWE4ZTVlNzY1N2EwYzk3OTc0ZDdjN2I2OWM4ZGIwMGNlOTUwMjZmIn0.eyJhdWQiOiIyIiwianRpIjoiZjVlZDA4OGZlOWZjZmYxMDI0NjQyNGI3NzA3ZjUzZGI1MTU5N2MxNDU5YThlNWU3NjU3YTBjOTc5NzRkN2M3YjY5YzhkYjAwY2U5NTAyNmYiLCJpYXQiOjE1NjkyMjI0MjUsIm5iZiI6MTU2OTIyMjQyNSwiZXhwIjoxNTcwNTE4NDI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GCWbPiTr0JMxN0moukisd8L-UZfiHXbQEeFZLUou3Wv7JK-IzCaNL7-rsKn2MXP02keA96pKyniqWmgU3j7OnZiQXXqzepXxcaYIMpXxuyWZmJTECHo9wyjrC9lusF-vTIjXxBslevxSf1-XyySXpMC1Z_ezIpet0cZruyGGCyw1ht_Bve1WubRbu8gB3qAPaQ0y4k19gC1vSvqEekgUZAig-gWGhE8zsPHQ5INd4qA7nckB1EwXLhnTh-zKmYoJs5nzJV_ei3qGDNMxRqbyvjiBMctdLXXIb4NjrT2-VEGSkltKWysAQzMBmLH6aZuNl4853RSnNuG40zVW3Rol5WJytsIWprYEnKWeHUoPaCcnMXyA2ir_5JqoqR8gssVpX01KZtd7BDHsQYuJhViAWhCQoVvQhDOrkwnDR2PY1xSUjQfkod-wgjWiueTH_TEJAl-zorwO7q6ltjIgJeEb2-qJFMfHHOh0AH_-Dqckrp-ETh5M1C8lrRq1_1VoTJlmHUmsdKQb7rn2DS-jqfR4gK3rTjWDWNrvf_oAu86J9wPvrev4cc8IfDrbvlpLOnGMMmQ5BZAI2g0RelkxfgoPuXxgr6aChFQx2watKuIaSrOglPNNx3zaHiko8-EA-g6QdPmHZr-h7J0LJohAi2aDyDZSgU672I_MXNYpW4uS4bE';

    //teacher token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0NzFkM2I3MTQzY2VmYWFiYTM2ODI5MzAwZWI4M2M5MDk3NjEyZTMwYmYxYjQ5ZjhiZGZiM2UxZTNkY2U3NDU5M2EyOTJiZDUyNWJhYmEyIn0.eyJhdWQiOiIyIiwianRpIjoiMjQ3MWQzYjcxNDNjZWZhYWJhMzY4MjkzMDBlYjgzYzkwOTc2MTJlMzBiZjFiNDlmOGJkZmIzZTFlM2RjZTc0NTkzYTI5MmJkNTI1YmFiYTIiLCJpYXQiOjE1NjkyMjMyOTYsIm5iZiI6MTU2OTIyMzI5NiwiZXhwIjoxNTcwNTE5Mjk2LCJzdWIiOiIxMCIsInNjb3BlcyI6W119.MTcMh8tH9cAWW--yyFVBYDQ5j1GEODMA32RXK2cpMp8phbKiRRviPleTpJMFi1xVEOtxI4n1vx3MF7WJqXMVswmCNUzjSoYronJeCa3Csvo17itrwzhHjU2wN-yRRLHRoJOm2BPDeVFRIYUN0DzGKxUwqAFJJnNDyk8yV2TRyYhS5nKi0BsxnWUtn7DuZT4ei5W2pYVjfxdVi-Znh7BBUim16ipGQdmjWxzytJBEzuLz_6j8ixptkO3-uYFEUywV5hCaxVIa1GMVPJyEqbaUMpG3pcvnCqR3_qbuiGsv5yLMT_Py7OzpR7htFPh_4HJxDfPV_WPx2_y0V-zdZ1Hq-BpcaEEnmp22TQGOx9BNq_qHCtsiiZB9gH8fT7NAyJlvPPlWmuWGKmbAWjJUIjvnfr3DqkymDtggbOzw8z_vU0GW-J3Eybjznw5dhpd-IEtnzuk6K5cKGiROwtgh2CgqUjKk0N08ZWT4IyFBNjxI7kDdF1s_bjaFznidFE_baMjkTo7XVBn4_c-KaR1sl7fg-WaOCXlZqS3YmRxo_HlEFj6WpRw3b2Dyv9D9DpsMuAvVjlDMIOjMkMuSZ6FFxx6cMh_o8p2YSjx5u2ael1UMO8TkwrXJhK9XLjzGBhZTSJXFdxaaPOyDfH00G8xFSwz_QgdJ81aC0mxPzEW3jSbY4yE';


    public function getMongoDBDao()
    {
        $mongodb = new MongoDbDao('47.112.99.100',27891,
            'root','root','sqdj','colleagues');
        return $mongodb;
    }

    /**
     *
     */
    public function testMongoDbCreateTest()
    {
      /*  $uri = "mongodb://root:root@47.112.99.100:27891";
        $client = new \MongoDB\Client($uri);

        $collection      = $client->sqdj->colleagues;
        $insertOneResult = $collection->insertOne([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'name'     => 'Admin User',
        ]);
        printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
        var_dump($insertOneResult->getInsertedId());*/

        $this->getMongoDBDao()->insertMany(
            array(  ['id' => 1, 'age' => 21, 'name' => '1xiaoli'],
                ['id' => 2, 'age' => 22, 'name' => '2xiaoli'],
                ['id' => 3, 'age' => 23, 'name' => '3xiaoli'],
                ['id' => 4, 'age' => 26, 'name' => '4xiaoli'],
                ['id' => 5, 'age' => 24, 'name' => '5xiaoli'],
                ['id' => 6, 'age' => 25, 'name' => '6xiaoli']));
    }

    public function testMongoDbFindTest()
    {
     /*   $uri = "mongodb://root:root@47.112.99.100:27891";
        $client = new \MongoDB\Client($uri);

        $collection      = $client->sqdj->colleagues;
        $document   = $collection->findOne(['username' => 'admin']);
        var_dump($document);*/
        $retList = $this->getMongoDBDao()->find(['age' => 22],['_id','id','name','age'],null,false,0,10);
        print_r(json_encode($retList));
    }

    public function testMongoDbPageTest()
    {
        /*   $uri = "mongodb://root:root@47.112.99.100:27891";
           $client = new \MongoDB\Client($uri);

           $collection      = $client->sqdj->colleagues;
           $document   = $collection->findOne(['username' => 'admin']);
           var_dump($document);*/
        $retList = $this->getMongoDBDao()->findByPage(['age' => 22],['_id','id','name','age'],null,false
            ,2,2);
        print_r(json_encode($retList));
    }


    public function testMongoDbUpdateTest()
    {
        $uri = "mongodb://root:root@47.112.99.100:27891";
        $client = new \MongoDB\Client($uri);

        $collection      = $client->sqdj->colleagues;
        $updateResult = $collection->updateOne(
            ['username' => 'admin'],
            ['$set' => ['username' => 'admin2', 'name' => 'new nickname']],
            ['upsert' => true]
        );
        printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
        printf("Modified %d document(s)\n", $updateResult->getModifiedCount());
        printf("Upserted %d document(s)\n", $updateResult->getUpsertedCount());
    }

    public function testMongoDeleteTest()
    {
        $uri = "mongodb://root:root@47.112.99.100:27891";
        $client = new \MongoDB\Client($uri);
        $collection      = $client->sqdj->colleagues;

        $deleteResult = $collection->deleteOne(['username' => 'admin2']);
        printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());
    }




}
