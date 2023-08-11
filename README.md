# Tpay OpenAPI library

Library for all methods available via OpenAPI [Tpay](https://tpay.com).

[![Latest stable version](https://img.shields.io/packagist/v/tpay-com/tpay-openapi-php.svg?label=current%20version)](https://packagist.org/packages/tpay-com/tpay-openapi-php)
[![PHP version](https://img.shields.io/packagist/php-v/tpay-com/tpay-openapi-php.svg)](https://php.net)
[![License](https://img.shields.io/github/license/tpay-com/tpay-openapi-php.svg)](LICENSE)
[![CI status](https://github.com/tpay-com/tpay-openapi-php/actions/workflows/ci.yaml/badge.svg?branch=master)](https://github.com/tpay-com/tpay-openapi-php/actions)
[![Type coverage](https://shepherd.dev/github/tpay-com/tpay-openapi-php/coverage.svg)](https://shepherd.dev/github/tpay-com/tpay-openapi-php)

[Polish version :poland: wersja polska](./README_PL.md)

## Installation

Install via [Composer](https://getcomposer.org):
```console
composer require tpay-com/tpay-openapi-php
```

Install via [Git](https://git-scm.com) over SSH:
```console
git clone git@github.com:tpay-com/tpay-openapi-php.git
```

Install via [Git](https://git-scm.com) over HTTPS:
```php
git clone https://github.com/tpay-com/tpay-openapi-php.git
```

Manual download:
https://github.com/tpay-com/tpay-openapi-php/archive/master.zip

## Configuration

The only thing you need to do is to set your [OAuth](https://oauth.net) credentials like in example config file ([see example](Examples/ExamplesConfig.php)).
You can generate access keys in [Tpay's merchant panel](https://panel.tpay.com).

The [`Loader.php`](Loader.php) file handles all required class loading, so you can include this file to any file you are editing.

All methods described in [Tpay OpenAPI documentation](https://openapi.tpay.com) can be easily executed by running one of the library methods like:
```php
$TpayApi = new TpayApi($clientId, $clientSecret, true, 'read');
$transactions = $this->TpayApi->Transactions->getTransactions();
```

All currently available API methods have an example usage in [`Examples`](Examples) directory.

### Example credentials

#### for all API calls:
```
  Client id: 1010-e5736adfd4bc5d8c
  Client secret: 493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7
```

#### for notifications validation:
```
  Confirmation code: demo
```

#### for credit card encrypting:
```
  Public Key: LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0NCk1JR2ZNQTBHQ1NxR1NJYjNEUUVCQVFVQUE0R05BRENCaVFLQmdRQ2NLRTVZNU1Wemd5a1Z5ODNMS1NTTFlEMEVrU2xadTRVZm1STS8NCmM5L0NtMENuVDM2ekU0L2dMRzBSYzQwODRHNmIzU3l5NVpvZ1kwQXFOVU5vUEptUUZGVyswdXJacU8yNFRCQkxCcU10TTVYSllDaVQNCmVpNkx3RUIyNnpPOFZocW9SK0tiRS92K1l1YlFhNGQ0cWtHU0IzeHBhSUJncllrT2o0aFJDOXk0WXdJREFRQUINCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ==
```

### Examples of usage

##### Frontend forms and payment handlers:

[Payment method choice form](Examples/TransactionsApi/BankSelectionForm.php), [BLIK method form](Examples/TransactionsApi/BlikPayment.php), [simple credit card form](Examples/TransactionsApi/CardGate.php), [extended credit card form](Examples/TransactionsApi/CardGateExtended.php), [recurrent payment example](Examples/TransactionsApi/RecurrentPayment.php), [payment notification webhook](Examples/Notifications/PaymentNotificationExample.php).

##### Merchant accounts registration (for partners only)

[Example of usages](Examples/AccountsApi/AccountsApiExample.php).

## Logs

Library has own logging system to save all API calls, responses, webhook notifications, and exceptions.
Make sure that `Logs` directory is writable and add rule to Apache `.htaccess` or NGINX to deny access to this area from browser.
The log files are created for each day separately.

The logging is enabled by default, but you can disable this feature by command:
```php
Logger::$loggingEnabled = false;
```

You can also set your own logging path by this command:
```php
Logger::$customLogPatch = '/my/own/path/Logs/';
```

The logs file names will be assigned automatically.

## Custom templates and static files path

You can set your own templates path, so you can copy and modify the `phtml` template files from this library.
```php
Util::$customTemplateDirectory = '/my/own/templates/path/';
```

You can set your own static files path, so you can copy and modify the `css` and `js` files from this library. By default, the path is based on `$_SERVER['REQUEST_URI']` value.
```php
Util::$libraryPath = '/my/own/path/';
```

## Language

The library supports two languages (English and Polish). Default language is English.
Change language example:
```php
// Any time you construct the class providing payment forms, you can pass the language in constructor
$paymentForms = new PaymentForms('pl');
// After this line all static messages (input labels, buttons titles etc.) will be displayed in Polish

// If you want to access translations manually, use:
$lang = new Lang();
$lang->setLang('pl'); // for setting language
$lang->lang('pay'); // to echo translated key
```

## License

This library is released under the [MIT License](http://www.opensource.org/licenses/MIT).
