<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/4
 * Time: 16:49
 */

/*$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$a2=array("e"=>"red","f"=>"green","g"=>"blue");

$result=array_intersect($a1,$a2);
print_r($result);*/

//$arr = array('Hello','World!','I','love','Shanghai!');
//echo implode(",",$arr);


//$string_to_search = "<p style=\"text-align: center; \"><img data-lazyload=\"https://img10.360buyimg.com/imgzone/jfs/t1/115720/31/3864/137085/5eaa60cbEc781d802/97404cce092adebc.jpg\"></p><div style=\"text-align: center;\"><dl class=\"specifi\" style=\"margin: 0px 20px; padding: 10px 0px; border-bottom-style: dotted; border-bottom-color: rgb(221, 221, 221); text-align: start;\"><dt style=\"text-align: center; margin: 0px; padding: 0px; line-height: 48px; font-weight: bold;\"><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-size:36px;\">温馨提示</span></span></dt><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"font-family:微软雅黑;color:#999999;\"><span style=\"font-size: 20px; white-space: normal;\">防水说明：面料可防泼水，水珠\油滴滴落在围裙上会自动滑落，</span></span></p><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"font-family:微软雅黑;color:#999999;\"><span style=\"font-size: 20px; white-space: normal;\">不防浸水的，介意慎拍！</span></span><span style=\"font-size: 20px; white-space: normal; color: rgb(153, 153, 153); font-family: 微软雅黑;\">！</span></p><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"font-size: 20px; white-space: normal; color: rgb(153, 153, 153); font-family: 微软雅黑;\">重要事情说三遍：</span></p><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"font-size: 20px; white-space: normal; font-family: 微软雅黑;\"><span style=\"color:#ff0000;\">围裙不防浸水，仅防泼水！</span></span></p><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"color: rgb(255, 0, 0); font-family: 微软雅黑; font-size: 20px; white-space: normal;\">围裙不防浸水，仅防泼水！</span></p><p style=\"text-align: center; line-height: 48px; margin: 0px; padding: 0px;\"><span style=\"color: rgb(255, 0, 0); font-family: 微软雅黑; font-size: 20px; white-space: normal;\">围裙不防浸水，仅防泼水！</span></p></dl></div>
//<p style=\"text-align: center; \"><img style=\"width:auto;height:auto;max-width:100%;\" data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/15521/19/12650/297827/5c99d14eE2ad2ccdf/07f437df25e57717.jpg\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/31685/27/7605/357991/5c99d0f8Eefdec99d/d46ae1bd728a892b.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/19809/9/12623/314205/5c99d0f9E3067f93b/1d770cf2524f7694.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/27253/39/12466/392008/5c99d0f9E364e90bd/c8c3eed1c7ba43b0.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/31290/29/7854/367369/5c99d0f9E24cb46f2/e103038902456d7a.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/21472/15/12609/323520/5c99d0f9E08f57daf/847ae6136253c0b6.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/28609/35/12775/376597/5c99d0faE295acf48/229593b2ca62265d.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/17634/24/12686/393975/5c99d0faE63a50220/0fb1208503e3f793.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/20096/23/12635/345557/5c99d0faE0836de63/a2d820cc0d24b1cf.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/20143/11/12685/128539/5c99d0faE6665fd8e/2accc642d2d5bd86.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><img data-lazyload=\"http://img10.360buyimg.com/imgzone/jfs/t1/16273/37/12516/138438/5c99d0fbEfe347c24/7e422d1f2d75a9b0.jpg\" style=\"text-align: left; width: auto; height: auto; max-width: 100%;\"><br></p><p><br></p><br/> ";
//$regex = "/[a-zA-z]+:\/\/[^\s]*/";
//$pat_array = [];
//$num_matches = preg_match_all($regex, $string_to_search,$pat_array);
//
//print_r($num_matches);
//print_r($pat_array);

/*if ($num_matches > 0) {
 echo "Found a match! ".$num_matches;
} else {
 echo "No match. Sorry.";
}*/


//$url = 'https://u.jd.com/gcDu5I\u00a0';
//$url = trim($url," \t\n\r\0\x0B\x00a0\u");
//print_r($url);


//$content = "<div>中国</div>";
//$html = htmlentities($content);
//$decodeContent = strip_tags($html);
//print_r($decodeContent);

$str = '天气';
//echo htmlspecialchars($str);
echo strip_tags($str);



