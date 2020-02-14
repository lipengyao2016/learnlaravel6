<?php
use xmpush\IOSBuilder;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;
use xmpush\Region;

include_once(dirname(__FILE__) . '/autoload.php');

$secret = '1D0q8aQjLJap7pY4CbV35g==';
$bundleId = 'com.dxkj.xgp';

Constants::setBundleId($bundleId);
Constants::setSecret($secret);

$aliasList = array('2', 'alias2');
$desc = '这是一条mipush推送消息';
$payload = '{"test":1,"ok":"It\'s a string"}';

$message = new IOSBuilder();
$message->description($desc);
$message->soundUrl('default');
$message->badge('4');
$message->extra('payload', $payload);
$message->build();

$sender = new Sender();

var_dump($sender);

// $sender->setRegion(Region::China);// 支持海外
print_r(' message fields:'.json_encode($message->getFields()). ' extra info:'.json_encode($message->getJSONInfos()));
$sendRet = $sender->sendToAliases($message, $aliasList);
print_r(' errorCode :' . $sendRet->getErrorCode().PHP_EOL);
print_r($sendRet->getRaw());


?>
