<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/4
 * Time: 16:49
 */


$patStr ='/.*\w{11}.*/';
//$content = 'fu植这行话₤8utK196JjGY₤转移至τáǒЬáǒ【夏季露肩连衣裙女夏2020新款女装收腰显瘦仙女超仙森系流行裙子年】；或https://m.tb.cn/h.V6qTNW5?sm=49bb90 點击链街，再选择瀏lan嘂..大开';
$content = 'asdfasgsdgasdgas';
$r = preg_match($patStr,$content);
print_r($r);



