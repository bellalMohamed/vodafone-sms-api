Vodafone Bulk SMS API

```
<?php

use Bellal\VodafoneSMS\VodafoneAdapter;

$message = new VodafoneAdapter([
    'accountId' => 'VODAFONE_ACCOUNT_ID',
    'password' => 'VODAFONE_PASS',
    'secretKey' => 'VODAFONE_SECRET_KEY',
    'senderName' => 'VODAFONE_SENDER_NAME',
]);

$result = $messageProviderInstance->send([
	'to' => 'RECIEVER_NUMBER',
	'text' => 'MESSAGE_BODY',
]);
```
