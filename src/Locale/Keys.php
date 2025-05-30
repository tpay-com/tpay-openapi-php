<?php

namespace Tpay\OpenApi\Locale;

use Tpay\OpenApi\Utilities\TpayException;

class Keys
{
    /** @var array<string, array<string, string>> */
    public static $translations = [];

    /** @var array<string> */
    private $keys = [
        // GLOBALS
        'fee_info',
        'pay',
        'merchant_info',
        'amount',
        'name',
        'address',
        'city',
        'zip',
        'country',
        'phone',
        'email',
        'order',
        // BLIK
        'blik_code_error',
        'blik_info',
        'blik_info2',
        'blik_accept',
        'codeInputText',
        // BANK SELECTION
        'cards_and_transfers',
        'other_methods',
        'accept',
        'regulations_url',
        'regulations',
        'acceptance_is_required',
        // CARD
        'card_number',
        'expiration_date',
        'signature',
        'name_on_card',
        'name_surname',
        'save_card',
        'save_card_info',
        'processing',
        'debit',
        'not_supported_card',
        'not_valid_card',
        'saved_card_label',
        'new_card_label',
    ];

    public function __construct()
    {
        self::initializeTranslations();
        $this->checkKeysTranslations();
    }

    protected static function initializeTranslations()
    {
        static::$translations = [
            'pl' => (new Polish())->translations,
            'en' => (new English())->translations,
        ];
    }

    private function checkKeysTranslations()
    {
        foreach ($this->keys as $key) {
            foreach (static::$translations as $key1 => $value) {
                if (!array_key_exists($key, $value)) {
                    throw new TpayException('Translation for key '.$key.' does not exist in '.$key1
                        .' translator.');
                }
            }
        }
        foreach (static::$translations as $key => $value) {
            foreach ($value as $item => $item2) {
                if (!in_array($item, $this->keys)) {
                    throw new TpayException('Translation for key '.$item.' exists in '.$key
                        .' translator but is not declared in keys array.');
                }
            }
        }
    }
}
