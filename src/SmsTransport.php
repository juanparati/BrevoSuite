<?php

namespace Juanparati\BrevoSuite;


use Juanparati\BrevoSuite\Exceptions\TransportException;
use Juanparati\BrevoSuite\Contracts\SmsTransport as BrevoSuiteSmsTransportContract;
use Brevo\Client\Api\TransactionalSMSApi;
use Brevo\Client\Model\SendTransacSms;


/**
 * Brevo SMS transport.
 *
 * @package Juanparati\BrevoSuite
 */
class SmsTransport implements BrevoSuiteSmsTransportContract
{

    /**
     * Brevo SMS instance.
     *
     * @var \Brevo\Client\Api\TransactionalSMSApi
     */
    protected TransactionalSMSApi $instance;


    /**
     * SmsTransport constructor.
     *
     * @param Client $apiClient
     */
    public function __construct(Client $apiClient)
    {
        $this->instance = $apiClient->getApi('TransactionalSMSApi');
    }


    /**
     * Send the SMS using the given sms message.
     *
     * @return string Message ID
     * @throws TransportException
     */
    public function send(Sms $message) : string
    {

        $data = $this->mapMessage($message->getModel());

        try
        {
            $response = $this->instance->sendTransacSms($data);
        }
        catch (\Exception $e)
        {
            throw new TransportException($e->getMessage());
        }

        $message_id = $response->getMessageId();

        if (empty($message_id))
            throw new TransportException('Unable to send SMS, due to unknown error');

        return $message_id;
    }


    /**
     * Transforms Model into SendTransacSms.
     *
     * @param SmsModel $message
     * @return SendTransacSms
     * @throws TransportException
     */
    protected function mapMessage(SmsModel $message): SendTransacSms
    {

        $sms = new SendTransacSms();


        // Set recipient
        if (!$message->recipient)
            throw new TransportException('Destination recipient is required', 100);

        $sms->setRecipient($message->recipient);


        // Set content
        $content = trim($message->content);

        if (!$content)
            throw new TransportException('Message content is missing', 111);

        $sms->setContent($content);


        // Set sender
        if (!$message->sender)
            throw new TransportException('Sender name is required', 1111);

        $sms->setSender(substr($message->sender, 0, 11));


        // Set type
        if ($message->type)
            $sms->setType($message->type);


        // Set tag
        if ($message->tag)
            $sms->setTag($message->tag);


        // Set webhook
        if ($message->webUrl)
            $sms->setWebUrl($message->webUrl);

        return $sms;
    }


}
