<?php
namespace tpaySDK\Model\Fields\BlikPaymentData;

use tpaySDK\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;

    protected $type = self::INT;

    protected $enum = [0, 1];

}
