<?php
namespace tpaySDK\Model\Fields\Account;

use tpaySDK\Model\Fields\Field;

class OfferCode extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 50;

}
