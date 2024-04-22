<?php

namespace Juanparati\BrevoSuite\Tests\test\Services;

use Brevo\Client\Api\AccountApi;
use Brevo\Client\Api\AttributesApi;
use Brevo\Client\Api\CompaniesApi;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Api\ConversationsApi;
use Brevo\Client\Api\CouponsApi;
use Brevo\Client\Api\CRMApi;
use Brevo\Client\Api\DealsApi;
use Brevo\Client\Api\DomainsApi;
use Brevo\Client\Api\EcommerceApi;
use Brevo\Client\Api\EmailCampaignsApi;
use Brevo\Client\Api\ExternalFeedsApi;
use Brevo\Client\Api\FilesApi;
use Brevo\Client\Api\FoldersApi;
use Brevo\Client\Api\ListsApi;
use Brevo\Client\Api\MasterAccountApi;
use Brevo\Client\Api\NotesApi;
use Brevo\Client\Api\ProcessApi;
use Brevo\Client\Api\ResellerApi;
use Brevo\Client\Api\SendersApi;
use Brevo\Client\Api\SMSCampaignsApi;
use Brevo\Client\Api\TasksApi;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Api\TransactionalSMSApi;
use Brevo\Client\Api\TransactionalWhatsAppApi;
use Brevo\Client\Api\UserApi;
use Brevo\Client\Api\WebhooksApi;
use Brevo\Client\Api\WhatsAppCampaignsApi;
use Juanparati\BrevoSuite\Client;
use Juanparati\BrevoSuite\Tests\BrevoSuiteTestCase;

class ServiceRegistrationTest extends BrevoSuiteTestCase
{
    public function testApiServiceRegistration()
    {
        $client = $this->app->make(Client::class);

        $this->assertInstanceOf(AccountApi::class, $client->getApi('AccountApi'));
        $this->assertInstanceOf(CompaniesApi::class, $client->getApi('CompaniesApi'));
        $this->assertInstanceOf(AttributesApi::class, $client->getApi('AttributesApi'));
        $this->assertInstanceOf(CRMApi::class, $client->getApi('CRMApi'));
        $this->assertInstanceOf(ContactsApi::class, $client->getApi('ContactsApi'));
        $this->assertInstanceOf(ConversationsApi::class, $client->getApi('ConversationsApi'));
        $this->assertInstanceOf(CouponsApi::class, $client->getApi('CouponsApi'));
        $this->assertInstanceOf(DealsApi::class, $client->getApi('DealsApi'));
        $this->assertInstanceOf(DomainsApi::class, $client->getApi('DomainsApi'));
        $this->assertInstanceOf(EcommerceApi::class, $client->getApi('EcommerceApi'));
        $this->assertInstanceOf(EmailCampaignsApi::class, $client->getApi('EmailCampaignsApi'));
        $this->assertInstanceOf(FoldersApi::class, $client->getApi('FoldersApi'));
        $this->assertInstanceOf(ExternalFeedsApi::class, $client->getApi('ExternalFeedsApi'));
        $this->assertInstanceOf(FilesApi::class, $client->getApi('FilesApi'));
        $this->assertInstanceOf(ListsApi::class, $client->getApi('ListsApi'));
        $this->assertInstanceOf(MasterAccountApi::class, $client->getApi('MasterAccountApi'));
        $this->assertInstanceOf(NotesApi::class, $client->getApi('NotesApi'));
        $this->assertInstanceOf(ProcessApi::class, $client->getApi('ProcessApi'));
        $this->assertInstanceOf(ResellerApi::class, $client->getApi('ResellerApi'));
        $this->assertInstanceOf(SMSCampaignsApi::class, $client->getApi('SMSCampaignsApi'));
        $this->assertInstanceOf(SendersApi::class, $client->getApi('SendersApi'));
        $this->assertInstanceOf(TasksApi::class, $client->getApi('TasksApi'));
        $this->assertInstanceOf(TransactionalEmailsApi::class, $client->getApi('TransactionalEmailsApi'));
        $this->assertInstanceOf(TransactionalSMSApi::class, $client->getApi('TransactionalSMSApi'));
        $this->assertInstanceOf(TransactionalWhatsAppApi::class, $client->getApi('TransactionalWhatsAppApi'));
        $this->assertInstanceOf(UserApi::class, $client->getApi('UserApi'));
        $this->assertInstanceOf(WebhooksApi::class, $client->getApi('WebhooksApi'));
        $this->assertInstanceOf(WhatsAppCampaignsApi::class, $client->getApi('WhatsAppCampaignsApi'));
    }

    public function testClassApiServiceRegistration()
    {
        $client = $this->app->make(Client::class);

        $this->assertInstanceOf(AccountApi::class, $client->getApi(AccountApi::class));
    }
}
