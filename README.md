# Brevo suite for Laravel

## What is it?

A complete [Brevo](https://www.brevo.com/) suite for Laravel.

It provides the following features

- Laravel native mail transport.
- Transactional template transport.
- Transactional SMS transport.
- Native Brevo services (Contacts, Marketing, Accounts, Sales, etc).


## Installation

For Laravel 11.x

      composer require juanparati/brevosuite "^11.0"

For Laravel 10.x

      composer require juanparati/brevosuite "^10.0"

For older Laravel versions check [Sendinblue v3 for Laravel](https://github.com/juanparati/Sendinblue).
   

1. Add the following configuration snippet into the "config/services.php" file

         'brevo' => [        
             'key'   => '[your api key]'
         ],

2. Change the mail driver to "brevo" into the "config/mail.php" file or the ".env" file (Remember that ".env" values will overwrite the config values). Example:
        
         'driver' => env('MAIL_MAILER', 'brevo'),

         'mailers' => [
             // ...
             'brevo' => [
                 'transport' => 'brevo'
             ]
             // ...
         ];


## Usage

### Transactional mail transport

Just use the transactional e-mails using the [Laravel Mail facade](https://laravel.com/docs/8.x/mail#sending-mail).


As soon that Brevo was configured as native mail transport you can use the following code in order to test it:

    // Paste this code inside "artisan tinker" console.
    Mail::raw('Test email', function ($mes) { 
        $mes->to('[youremail@example.tld]'); 
        $mes->subject('Test'); 
    });


### Transactional mail template transport

The transactional mail template transport allow to send templates as transactional e-mails using Brevo.

It's possible to register the mail template transport facade into the "config/app.php":

        'MailTemplate' => Juanparati\BrevoSuite\Facades\Template::class,

Now it's possible to send templates in the following way:

        MailTemplate::to('user@example.net');           // Recipient
        MailTemplate::cc('user2@example.net');          // CC
        MailTemplate::bcc('user3@example.net');         // BCC
        MailTemplate::replyTo('boss@example.net');      // ReplyTo
        MailTemplate::attribute('NAME', 'Mr User');     // Replace %NAME% placeholder into the template 
        MailTemplate::attach('file.txt');               // Attach file
        MailTemplate::attachURL('http://www.example.com/file.txt'); // Attach file from URL
        MailTemplate::send(100);                        // Send template ID 100 and return message ID in case of success

It's possible to reset the template message using the "reset" method:

        MailTemplate::to('user@example.net');           // Recipient
        MailTemplate::cc('user5@example.net');          // Second recipient
        MailTemplate::attribute('TYPE', 'Invoice');     // Replace %TYPE% placeholder
        MailTemplate::send(100);                        // Send template
        
        MailTemplate::to('user2@example.net');          // Another recipient
        MailTemplate::send(100);                        // Send template but attribute "type" and second recipient from previous e-mail is used
        
        MailTemplate::reset();                          // Reset message
        
        MailTemplate::to('user3@example.net');          
        MailTemplate::send(100);                        // Send template but previous attribute and second recipient is not used.
                

It's also possible enclose the mail message into a closure so the call to the "reset" method is not necessary:

        MailTemplate::send(100, function ($message) {
            $message->to('user2@example.net');
            
            // Note: Your template should contains the placeholder attributes surrounded by "%" symbol.
            // @see: https://help.brevo.com/hc/en-us/articles/360000268730-How-to-customize-your-transactional-emails
            $message->attributes(['placeholder1' => 'one', 'placeholder2' => 'two']);
            ...
        });        


### Transactional SMS

The transactional SMS allow to send SMS using the Brevo SMS transport.

I's possible to register the SMS transport facade into the "config/app.php":

        'SMS' => Juanparati\BrevoSuite\Facades\Sms::class,

Usage examples:

        SMS::sender('TheBoss');         // Sender name (Spaces and symbols are not allowed)
        SMS::to('45123123123');         // Mobile number with internal code (ES)
        SMS::message('Come to work!');  // SMS message
        SMS::tag('lazydev');            // Tag (Optional)
        SMS::webUrl('http://example.com/endpoint'); // Notification webhook (Optional);
        SMS::send();
        
Like the transactional template transport, it is also possible reset the state using the "reset" method or just using a closure:

        SMS::send(function($sms) {
            $sms->to('45123123123');
            $sms->sender('Mr Foo');
            $sms->message('Hello Mr Bar');
            ...
        });
        

### Laravel notifications

The following classes are provided as message builder for Laravel notifications:

- TemplateMessage
- SmsMessage


### API Client

By default, this library uses the official [GetBrevo PHP library](https://github.com/getbrevo/brevo-php).

In order to interact with the official library it's possible to inject the custom APIs in the following way:

        // Obtain APIClient
        $apliClient = app()->make(\Juanparati\BrevoSuite\Client::class);
        
        // Use the APIClient with the Brevo ContactsAPI
        $contactsApi = $apliClient->getApi('ContactsApi');
        
        // Retrieve the first 10 folders
        $folders = $contactsApi->getFolders(10, 0);  

Another example using Sendinblue models:

        $apiClient = app()->make(\Juanparati\BrevoSuite\Client::class);
        $contactsApi = $apiClient->getApi('ContactsApi');

        // Use CreateContact model
        $contact = $apiClient->getModel('CreateContact', ['email' => 'test@example.net', 'attributes' => ['TYPE' => 4, 'NOM' => 'test', 'PRENOM' => 'test'], 'listIds' => [22]]);

        try {
            $contactsApi->createContact($contact);
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }

See the [GetBrevo PHP library](https://github.com/getbrevo/brevo-php) for more details.    


### Supported by

This project was made possible by [Matchbanker.no](https://matchbanker.no/).
