<?php
namespace Juanparati\BrevoSuite\Contracts;

use Juanparati\BrevoSuite\Client;
use Juanparati\BrevoSuite\Sms;


interface SMSTransport
{

    /**
     * SmsTransport constructor.
     *
     * @param Client $apiClient
     */
    public function __construct(Client $apiClient);


    /**
     * Send the SMS using the given message.
     *
     * @param Sms $message
     * @return string Message ID
     */
    public function send(Sms $message) : string;

}
