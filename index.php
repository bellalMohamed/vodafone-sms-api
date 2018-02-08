<?php
use Bellal\VodafoneSMS\VodafoneAdapter;

require 'vendor/autoload.php';

$message = new VodafoneAdapter([
	'accountId' => 'ACCOUNT_ID',
	'password' => 'PASSWORD',
	'secretKey' => 'SECRET_KEY',
	'senderName' => 'SENDER_NAME',
]);

$data = $message->send([
	'to' => 'Mobile number',
	'text' => 'You message body',
]);
