<?php

namespace Bellal\VodafoneSMS;

use Bellal\VodafoneSMS\Message\MessageInterface;

class VodafoneAdapter implements MessageInterface
{
	/**
	 * Vodafone API Credentails
	 * @var array
	 */
    protected $credentials;
    /**
     * HMAC Secure HASH
     * @var string
     */
    protected $secureHash;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Send SMS
     * @param  array  $data send to, message text
     * @return json
     */
    public function send(array $data)
    {
    	$formatedData = $this->formatData($data);
    	$this->secureHash = $this->generateHMAC($formatedData);

    	$result = $this->processMessageSend($data);

    	header('Content-type: application/json');
    	return json_encode($result);
    }

    /**
     * Proccess HTTP Request to send the SMS
     * @param  array $data
     * @return array         response data
     */
    protected function processMessageSend(array $data)
    {
    	$url = 'https://e3len.vodafone.com.eg/web2sms/sms/submit/';
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type: application/xml']);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS,
		"<?xml version='1.0' encoding='UTF-8'?>
		<SubmitSMSRequest xmlns:='http://www.edafa.com/web2sms/sms/model/' xmlns:xsi='http://www.w3.org/2001/XMLSchema - instance' xsi:schemaLocation='http://www.edafa.com/web2sms/sms/model/ SMSAPI.xsd ' xsi:type='SubmitSMSRequest'>
			<AccountId>{$this->credentials['accountId']}</AccountId>
			<Password>{$this->credentials['password']}</Password>
			<SecureHash>{$this->secureHash}</SecureHash>
			<SMSList>
				<SenderName>{$this->credentials['senderName']}</SenderName>
				<ReceiverMSISDN>{$data['to']}</ReceiverMSISDN>
				<SMSText>{$data['text']}</SMSText>
			</SMSList>
		</SubmitSMSRequest>");
		$result = curl_exec($ch);
		curl_close($ch);

		$response = json_decode(json_encode(simplexml_load_string($result)), true);

        return $response;
    }

    /**
     * Format Data to be hashed
     * @param  array $data
     * @return string
     */
    protected function formatData($data) {
		return "AccountId={$this->credentials['accountId']}&Password={$this->credentials['password']}&SenderName={$this->credentials['senderName']}&ReceiverMSISDN={$data['to']}&SMSText={$data['text']}";
    }

   /**
    * Generate HMAC SHA-256 (SecureHash)
    * @param  string $formatedData
    * @return string
    */
    protected function generateHMAC($formatedData)
    {
		$hash = hash_hmac('sha256', $formatedData, $this->credentials['secretKey']);
		$hash = strtoupper($hash);
		return $hash;
    }
}
