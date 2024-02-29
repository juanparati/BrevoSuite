<?php

namespace Juanparati\BrevoSuite\Tests\Test\Transport;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Juanparati\BrevoSuite\Tests\BrevoSuiteTestCase;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoApiTransport;

class MailTransportTest extends BrevoSuiteTestCase
{

    /**
     * Prototype for fake message
     */
    protected const FAKE_MESSAGE = [
        'message' => 'Test email',
        'subject' => 'Test'
    ];

    public function testCanRegisterMailTransport()
    {
        $mailer = Mail::mailer('brevo');
        $this->assertInstanceOf(Mailer::class, $mailer);

        /**
         * @var BrevoApiTransport $transport
         */
        $transport = $mailer->getSymfonyTransport();
        $this->assertInstanceOf(BrevoApiTransport::class, $transport);
    }


    /**
     * Test normal transaction e-mail.
     *
     * @throws \Juanparati\BrevoSuite\Exceptions\TransportException
     */
    public function testMailTransportRealSend()
    {
        if (!$this->app['config']->get('services.brevo.key'))
            $this->markTestSkipped('Real test requires an API key');

        $response = Mail::raw(static::FAKE_MESSAGE['message'], function ($mes) {
            $mes->to($this->sinkRecipient);
            $mes->subject(static::FAKE_MESSAGE['subject']);
        });

        $this->assertNotEmpty($response->getMessageId());
        $this->assertEquals($response->getEnvelope()->getRecipients()[0]->getAddress(), $this->sinkRecipient);
    }
}
