<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Marketplace;

use Tpay\OpenApi\Model\Fields\Field;

class TransactionStatus extends Field
{
    protected $name = 'transactionStatus';
    protected $type = self::STRING;
    protected $enum = ['correct'];
}
