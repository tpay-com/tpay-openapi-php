<?php
namespace tpaySDK\Model\Fields\PointOfSaleSettings;

use tpaySDK\Model\Fields\Field;

class IsTestMode extends Field
{
    protected $name = __CLASS__;

    protected $type = self::BOOL;

    protected $value = false;

}
