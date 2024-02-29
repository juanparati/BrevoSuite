<?php

namespace Juanparati\BrevoSuite\Tests\Test\Transport;

use Juanparati\BrevoSuite\Sms;
use Juanparati\BrevoSuite\Tests\BrevoSuiteTestCase;

class SmsTransportTest extends BrevoSuiteTestCase
{

    /**
     * Prototype for fake message
     */
    protected const FAKE_MESSAGE = [
        'message' => 'Test sms',
        'sender' => 'Test'
    ];


    /**
     * Test normal transaction e-mail.
     *
     * @throws \Juanparati\BrevoSuite\Exceptions\TransportException
     */
    public function testSmsTransportRealSend()
    {
        if (!$this->app['config']->get('services.brevo.key') || !$this->sinkSmsRecipient)
            $this->markTestSkipped('Real test requires an API key and/or a sink recipient');

        $sms = $this->app->make(Sms::class);

        $id = $sms->send(function($mes) {
            $mes->to($this->sinkSmsRecipient);
            $mes->message(static::FAKE_MESSAGE['message']);
            $mes->sender(static::FAKE_MESSAGE['sender']);
        });

        $this->assertNotEmpty($id);
    }
}
