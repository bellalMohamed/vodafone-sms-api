<?php

use Bellal\VodafoneSMS\VodafoneAdapter;

require 'vendor/autoload.php';


$message = new VodafoneAdapter([
	'accountId' => '101005212',
	'password' => 'Vodafone.1',
	'secretKey' => '706D1665E0CC45B98ED828BFFF68AFDF',
	'senderName' => 'ZEAL',
]);

$data = $message->send([
	'to' => '01026525200',
	'text' => 'Hey how are you :D',
]);
