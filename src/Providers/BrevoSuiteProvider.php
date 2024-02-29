<?php

namespace Juanparati\BrevoSuite\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Juanparati\BrevoSuite\Client;
use Juanparati\BrevoSuite\Sms;
use Juanparati\BrevoSuite\SmsTransport;
use Juanparati\BrevoSuite\Template;
use Juanparati\BrevoSuite\TemplateTransport;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

/**
 * Class ServiceProvider.
 *
 * @package Juanparati\BrevoSuite
 */
class BrevoSuiteProvider extends LaravelServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Mail::extend('brevo', function () {
            return (new BrevoTransportFactory())->create(
                new Dsn(
                    'brevo+api',
                    'default',
                    $this->app['config']['services.brevo.key'],
                )
            );
        });
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {

        // Register Brevo API client
        $this->app->singleton(Client::class, function ($app)
        {
            return new Client($app['config']['services.brevo']);
        });

        $this->app->alias(Client::class, class_basename(Client::class));


        // Register Brevo Template
        $this->app->bind(Template::class, function ($app)
        {
            return (new Template($app[Client::class], new TemplateTransport($app[Client::class])));
        });

        $this->app->alias(Template::class, 'BrevoSuite' . class_basename(Template::class));


        // Register Brevo SMS
        $this->app->bind(Sms::class, function ($app)
        {
            return (new Sms(new SmsTransport($app[Client::class])));
        });

        $this->app->alias(Sms::class, 'BrevoSuite' . class_basename(Sms::class));

    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return ['brevo'];
    }
}
