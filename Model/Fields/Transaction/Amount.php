<?php
namespace tpaySDK\Model\Fields\Transaction;

use tpaySDK\Model\Fields\Field;

class Amount extends Field
{
    protected $name = __CLASS__;

    protected $type = self::NUMBER;

    protected $minimum = 0.01;

}
