<?php
namespace tpaySDK\Model\Fields\PointOfSaleSettings;

use tpaySDK\Model\Fields\Field;

class ConfirmationCode extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 32;

}
