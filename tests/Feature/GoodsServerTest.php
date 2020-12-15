<?php

namespace Tests\Feature;


use App\Common\UrlUtils;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
class GoodsServerTest extends TestCase
{


    //prod token
    public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE2MDMyNzM2OTcsImV4cCI6MTY2MzI3MzYzNywibmJmIjoxNjAzMjczNjk3LCJqdGkiOiI0N1JrN1FiODNNSEthNVJWIiwic3ViIjo0NjU1MzksInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.1JXOYBvEPrdRruoZhCnDVahJroAx1n0D5J6v32PPf3I';

    // test token
   // public  $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LnNxa2RqLmNvbVwvdXNlclwvdG9rZW4iLCJpYXQiOjE1ODc2NDA3NTIsImV4cCI6MTY0NzY0MDY5MiwibmJmIjoxNTg3NjQwNzUyLCJqdGkiOiJqNE1vN3ZsNGkwbUNHT2YxIiwic3ViIjo1MiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.BEh37G9vcKL1xEPBu6d71JMZ1GwpJvMV2A8bFryjDUs';
    // public  $host = 'http://127.0.0.1:8010';
   public  $host = 'http://test.sqkdj.com';
  //public  $host = 'http://sj.gateway.com';
   // public  $host = 'http://120.77.228.81';

//  public  $host = 'http://api.sqkdj.com';

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

    public function testCustom_push()
    {
        $loginData = [
            'uid' => 465539,
            'title'=> '天然皂粉',
            'content'=> "<div>5斤券后仅9.9元皂粉刺激性更低、不伤手xx</div>",
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/custom_push',$loginData,1);
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
            'plate' => 'recommend',
        //    'cid' => 2,
         /*   'order_by' => 'sort',  //sell,price
            'sort_by' => 'desc',*/
           'item_source'=>1,
          //  'price_zone_type' => 1,
           // 'has_coupon' => 'true',
           // 'user_defined' =>3506,
        ];
        print_r(json_encode($loginData));
      //  $response = curl($this->host.'/app/v1/local_goods',$loginData,0,0,null,$this->accessToken);

        $cmd = 'local_goods';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);
    }

    public function testGetGoodsDetails()
    {
        $loginData = [
            'goods_id' => '607365558342',//
            'is_network_commodity'=>1,
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
      //  $response = curl($this->host.'/app/v1/goods/detail',$loginData,0,0,null,$this->accessToken);

        $cmd = 'goods/detail';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/app/v1/',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testGetOpenGoodsDetails()
    {
        $loginData = [
            'goods_id' => '608769703130',//
             'is_network_commodity'=>1,
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
        //  $response = curl($this->host.'/app/v1/goods/detail',$loginData,0,0,null,$this->accessToken);

        $cmd = 'goods/detail';
        $method = 'get';
        $response =AikAppReq::sendReq($this->host.'/open/v1/',$loginData,$cmd,$method,$this->accessToken);

    }



    public function testGetGoodsLocalCoupon()
    {
        $loginData = [
            'goods_id' => '524078440321',//
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
          $response = curl($this->host.'/open/v1/goods/local_coupon',$loginData,0,0,null,$this->accessToken);

//        $cmd = '/goods/local_coupon';
//        $method = 'get';
//        $response =AikAppReq::sendReq($this->host.'/open/v1',$loginData,$cmd,$method,$this->accessToken);

    }

    public function testSearchOnlineGoods()
    {
        $loginData = [
            'has_coupon' => 'false',
            'page_no'=>1,
          // 'keyword'=>'https://item.taobao.com/item.htm?id=521182368686',
           // 'keyword'=>'keyword=【】https://m.tb.cn/h.3qQQxl1?sm=1a2abb 点击链接，再选择浏览器咑閞；或復·制这段描述￥Z2BCboEUxqn￥后到淘♂寳♀　　',
            'keyword'=>'2020夏季童装纯棉工厂直销纯色儿童马卡龙短袖爆款百搭童t恤',
//            'keyword'=>'德国汉佳欧斯（HanJiaOurs）绞肉机电动绞肉机家用多功能绞馅机搅肉机绞菜机碎肉婴儿辅食机料理机 XD271【2L玻璃碗】',
           // 'keyword'=>'衣服',
            'source'=>1,
           // 'sort'=>'sales_asc',
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
            'goods_id' => '39222083238',
            'item_source'=>1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/app/v1/goods/relation',$loginData,0,0,null,$this->accessToken);
    }

    public function testGetGoodsHitInfo()
    {
        $loginData = [
            'item_source' => 1,
            'commission_rate' => 0.0079,
            'goods_id' => '607365558342',
            'use_coupon_price' => 39,
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
            'goods_id' => '571172617757',
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

    public function testOpenLocalGoods()
    {
        $loginData = [
            'page_no' =>2,
            'limit' => 10,
            //  'title' =>'法国原装进口 布瑞弗尼4段儿童配方牛奶200ml*6支*2 盒',
              'section' => 'cheap_mail',
               'order_by' => 'use_coupon_price',  //volume,use_coupon_price
               'sort_by' => 'asc',
             'item_source'=>1,
             'has_coupon' => 1,
        ];
        print_r(json_encode($loginData));
        $response = curl($this->host.'/open/v1/local_goods',$loginData,0,0,null,$this->accessToken);
    }


}
