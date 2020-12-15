<?php

$rk = new RdKafka\Consumer();
//$rk->setLogLevel(LOG_DEBUG);
/*$rk->addBrokers("47.107.246.243");
$topic = $rk->newTopic("test_lpy");*/

//$rk->addBrokers("47.112.120.178");
//$topic = $rk->newTopic("new_msg_push");

$rk->addBrokers("8.129.220.209");
$topic = $rk->newTopic("fanli_yugu_binlog");

$topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

while (true) {
    $msg = $topic->consume(0, 1000);
    if (null === $msg) {
        continue;
    }
    /* elseif ($msg->err) {
        echo $msg->errstr(), "\n";
        break;
    } */
    else {
        echo $msg->payload, "\n";
    }
}
