<?php
namespace Juanparati\BrevoSuite;


use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * SmsMessage is a wrapper for Laravel notifications messages
 *
 * @package Juanparati\BrevoSuite
 */
class SmsMessage
{

    /**
     * Template instance.
     *
     * @var Sms
     */
    protected Sms $instance;


    /**
     * TemplateMessage constructor.
     *
     * @param string $content
     * @param string $type
     * @throws BindingResolutionException
     */
    public function __construct(string $content, string $type = 'transactional')
    {
        $this->instance = app()->make(Sms::class);
        $this->instance->message($content);
        $this->instance->type($type);
    }


    /**
     * Call Template instance methods.
     *
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        call_user_func_array([$this->instance, $name], $arguments);

        return $this;
    }


    /**
     * Send message.
     *
     * @return int
     */
    public function send() : int
    {
        return $this->instance->send();
    }

}
