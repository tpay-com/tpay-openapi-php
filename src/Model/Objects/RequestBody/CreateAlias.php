<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\CreateAlias\Description;
use Tpay\OpenApi\Model\Fields\CreateAlias\Lang;
use Tpay\OpenApi\Model\Objects\Blik\CreateAliasPay;
use Tpay\OpenApi\Model\Objects\Objects;

class CreateAlias extends Objects
{
    const OBJECT_FIELDS = [
        'description' => Description::class,
        'lang' => Lang::class,
        'pay' => CreateAliasPay::class,
    ];

    /** @var Description */
    public $description;

    /** @var Lang */
    public $lang;

    /** @var CreateAliasPay */
    public $pay;

    public function getRequiredFields()
    {
        return [
            $this->description,
            $this->pay,
        ];
    }
}
