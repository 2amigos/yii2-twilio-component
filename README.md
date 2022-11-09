# Twilio Application Component for Yii2

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://poser.pugx.org/2amigos/yii2-twilio-component/downloads)](https://packagist.org/packages/2amigos/yii2-twilio-component)

[Twilio](https://www.twilio.com) is an awesome service that allows to include programmable SMS, Voice, Video, and Chat 
services in your apps. For Server side only Voice and SMS services are available. 

This component is a simple wrapper to ease Yii2 framework developers the job to send SMS and start Voice calls with 
Twilio. 

## Install

Via Composer

```bash
$ composer require 2amigos/yii2-twilio-component
```

## Usage

### Sign up for a Twilio Account

To use the [Twilio REST API](https://www.twilio.com/docs/api/rest), you need an account. [Signing up for a free Twilio 
account is easy](https://www.twilio.com/try-twilio). Once you've signed up, head over to your 
[Console](https://www.twilio.com/console) and grab your Account SID and your Auth Token. 

### Purchase an SMS Capable Phone Number 

Sending SMS messages requires an SMS capable phone number. You can browse the available phone numbers in the Console. 
Be sure that the phone number you buy is SMS capable. When you search, you can check the box to filter available numbers 
to those that are SMS capable.

Once you have the Twilio phone number you are ready to configure your application component. 

### Configuring the Component

You have to take the Account SID, the Auth Token and the purchased phone number and configure the component: 

```php 
// On your application config file 
// ... 
'components' => [
    'twilio' => [
        'class' => '\dosamigos\twilio\TwilioComponent',
        'sid' => 'ACCOUNT_SID',
        'token' => 'AUTH_TOKEN',
        'phoneNumber' => 'PURCHASED_PHONE_NUMBER'
    ]
]
```

### Sending an SMS 

Now that the application component has been set, you can do the following to send SMS: 

```php 

$message = Yii::$app->twilio->sms('VALID_PHONE_NUMBER_TO_SEND_SMS', 'Hello World!');

// It returns a \Twilio\Rest\Api\V2010\Account\MessageInstance
echo $message->sid;

```

In case you wish to use another purchased phone number, you can override the one configured as follows: 

```php 

$message = Yii::$app->twilio->sms('VALID_PHONE_NUMBER_TO_SEND_SMS', 'Hello World!', [
 'from' => 'ANOTHER_PURCHASED_TWILIO_PHONE_NUMBER'
]);

// It returns a \Twilio\Rest\Api\V2010\Account\MessageInstance
echo $message->sid;

```

## Using code fixer

We have added a PHP code fixer to standardize our code. It includes Symfony, PSR2 and some contributors rules. 

```bash 
./vendor/bin/php-cs-fixer fix ./src --config .php_cs
```

## Why there are no tests? 

The component is too simple to include tests as its a wrapper to Twilio's client library and the library has already 
all the required tests to check the functionality. 

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [2amigos](https://github.com/2amigos)
- [All Contributors](../../contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>Custom Software | Web & Mobile Development</i><br>
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
