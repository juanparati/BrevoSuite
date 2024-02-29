<?php
namespace Juanparati\BrevoSuite\Tests;

use Illuminate\Config\Repository;
use Juanparati\BrevoSuite\Providers\BrevoSuiteProvider;
use Orchestra\Testbench\TestCase;

class BrevoSuiteTestCase extends TestCase
{

    protected string $sinkRecipient;
    protected ?string $sinkSmsRecipient;

    protected function getPackageProviders($app)
    {
        return [BrevoSuiteProvider::class];
    }

    protected function defineEnvironment($app) {
        tap($app['config'], function (Repository $config) {
            $config->set('mail.default', 'brevo');
            $config->set('mail.mailers.brevo.transport', 'brevo');
            $config->set('services.brevo.key', env('BREVO_API_KEY'));
        });
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->sinkRecipient = env('SINK_RECIPIENT', 'example@example.net');
        $this->sinkSmsRecipient = env('SINK_SMS_RECIPIENT');
    }
}
