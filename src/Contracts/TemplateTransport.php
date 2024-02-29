<?php
namespace Juanparati\BrevoSuite\Contracts;

use Juanparati\BrevoSuite\Client;
use Juanparati\BrevoSuite\Template;

interface TemplateTransport
{

    /**
     * @param Client $apiClient
     */
    public function __construct(Client $apiClient);


    /**
     * Send the message using the given mailer.
     *
     * @param int $templateId
     * @param Template $message
     * @return string Message ID
     */
    public function send(int $templateId, Template $message) : string;

}
