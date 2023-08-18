# Tpay OpenAPI library

Biblioteka dla wszystkich metod dostępnych przez OpenAPI [Tpay](https://tpay.com).

[![Najnowsza stabilna wersja](https://img.shields.io/packagist/v/tpay-com/tpay-openapi-php.svg?label=obecna%20wersja)](https://packagist.org/packages/tpay-com/tpay-openapi-php)
[![Wersja PHP](https://img.shields.io/packagist/php-v/tpay-com/tpay-openapi-php.svg?label=licencja)](https://php.net)
[![Licencja](https://img.shields.io/github/license/tpay-com/tpay-openapi-php.svg?label=licencja)](LICENSE)
[![CI status](https://github.com/tpay-com/tpay-openapi-php/actions/workflows/ci.yaml/badge.svg?branch=master)](https://github.com/tpay-com/tpay-openapi-php/actions)
[![Pokrycie typami](https://shepherd.dev/github/tpay-com/tpay-openapi-php/coverage.svg)](https://shepherd.dev/github/tpay-com/tpay-openapi-php)

[English version :gb: wersja angielska](./README.md)

## Instalacja

Instalacja poprzez [Composer](https://getcomposer.org):
```console
composer require tpay-com/tpay-openapi-php
```

Instalacja poprzez [Git](https://git-scm.com) z SSH:
```console
git clone git@github.com:tpay-com/tpay-openapi-php.git
```

Instalacja poprzez [Git](https://git-scm.com) z HTTPS:
```php
git clone https://github.com/tpay-com/tpay-openapi-php.git
```

Ręczne pobieranie:
https://github.com/tpay-com/tpay-openapi-php/archive/master.zip

## Konfiguracja

Jedyne, co musisz zrobić, to ustawić dane uwierzytelniające [OAuth](https://oauth.net), tak jak w przykładowym pliku konfiguracyjnym ([zobacz przykład](Examples/ExamplesConfig.php)).
Klucze dostępu możesz wygenerować w [panelu sprzedawcy Tpay](https://panel.tpay.com).

Plik [`src/Loader.php`](src/Loader.php) obsługuje ładowanie wszystkich wymaganych klas, więc możesz dołączyć ten plik do dowolnego pliku, który edytujesz.

Wszystkie metody opisane w [dokumentacji Tpay OpenAPI](https://openapi.tpay.com) można łatwo wykonać, uruchamiając jedną z metod z tej biblioteki, takie jak:
```php
$TpayApi = new TpayApi($clientId, $clientSecret, true, 'read');
$transactions = $this->TpayApi->Transactions->getTransactions();
```

Wszystkie obecnie dostępne metody API mają przykładowe użycie w katalogu [`Examples`](Examples).

### Przykładowe dane uwierzytelniające

#### dla wszystkich wywołań API:
```
  Client id: 1010-e5736adfd4bc5d8c
  Client secret: 493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7
```

#### dla sprawdzania poprawności powiadomień:
```
  Confirmation code: demo
```

#### dla szyfrowania kart kredytowych:
```
  Public Key: LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0NCk1JR2ZNQTBHQ1NxR1NJYjNEUUVCQVFVQUE0R05BRENCaVFLQmdRQ2NLRTVZNU1Wemd5a1Z5ODNMS1NTTFlEMEVrU2xadTRVZm1STS8NCmM5L0NtMENuVDM2ekU0L2dMRzBSYzQwODRHNmIzU3l5NVpvZ1kwQXFOVU5vUEptUUZGVyswdXJacU8yNFRCQkxCcU10TTVYSllDaVQNCmVpNkx3RUIyNnpPOFZocW9SK0tiRS92K1l1YlFhNGQ0cWtHU0IzeHBhSUJncllrT2o0aFJDOXk0WXdJREFRQUINCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ==
```

### Przykłady użycia

##### Formularze frontendowe i moduły obsługi płatności:

[Formularz wyboru metody płatności](Examples/TransactionsApi/BankSelectionForm.php), [Formularz metody BLIK](Examples/TransactionsApi/BlikPayment.php), [Prosty formularz karty kredytowej](Examples/TransactionsApi/CardGate.php), [Rozszerzony formularz karty kredytowej](Examples/TransactionsApi/CardGateExtended.php), [Przykład płatności cyklicznej](Examples/TransactionsApi/RecurrentPayment.php), [Webhook z powiadomieniem o płatności](Examples/Notifications/PaymentNotificationExample.php).

##### Rejestracja kont handlowców (tylko dla partnerów)

[Przykład użycia](Examples/AccountsApi/AccountsApiExample.php).

## Logi

Biblioteka posiada własny system logowania do zapisywania wszystkich wywołań API, odpowiedzi, powiadomień webhook i wyjątków.
Upewnij się, że katalog `Logs` jest zapisywalny i dodaj regułę do Apache `.htaccess` lub NGINX, aby zabronić dostępu do tego obszaru z przeglądarki.
Pliki logów tworzone są dla każdego dnia oddzielnie.

Logowanie jest domyślnie włączone, ale możesz wyłączyć tę funkcję za pomocą polecenia:
```php
Logger::$loggingEnabled = false;
```

Możesz także ustawić własną ścieżkę logowania za pomocą tego polecenia:
```php
Logger::$customLogPatch = '/my/own/path/Logs/';
```

Nazwy plików dzienników zostaną przypisane automatycznie.

## Niestandardowa ścieżka szablonów

Możesz ustawić własną ścieżkę szablonów, dzięki czemu możesz kopiować i modyfikować pliki szablonów `phtml` z tej biblioteki.
```php
Util::$customTemplateDirectory = '/my/own/templates/path/';
```

Możesz ustawić własną ścieżkę dla plików statycznych, dzięki czemu możesz kopiować i modyfikować pliki `css` i `js` z tej biblioteki. Domyślnie ścieżka jest oparta na wartości `$_SERVER['REQUEST_URI']`.
```php
Util::$libraryPath = '/my/own/path/';
```

## Język

Obecnie biblioteka obsługuje dwa języki (angielski i polski). Domyślnym językiem jest angielski.
Przykład zmiany języka:
```php
// Za każdym razem, gdy konstruujesz klasę udostępniającą formularze płatności, możesz przekazać język w konstruktorze
$paymentForms = new PaymentForms('pl');
// Po tej linii wszystkie komunikaty statyczne (etykiety wejść, tytuły przycisków itp.) będą wyświetlane w języku polskim

// Jeśli chcesz ręcznie uzyskać dostęp do tłumaczeń, użyj:
$lang = new Lang();
$lang->setLang('pl'); // do ustawienia języka
$lang->lang('pay'); // aby wyświetlić przetłumaczony klucz
```

## Licencja

Ta biblioteka jest udostępniana na [licencji MIT](http://www.opensource.org/licenses/MIT).
