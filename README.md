Vodafone Bulk SMS API
# Installing Package

The recommended way to install is through
[Composer](https://getcomposer.org/).

```bash
composer require bellal/vodafone-sms
```

```
<?php

use Bellal\VodafoneSMS\VodafoneAdapter;

$messageProviderInstance = new VodafoneAdapter([
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
