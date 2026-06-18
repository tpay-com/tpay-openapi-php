<?php

declare(strict_types=1);

namespace Tpay\OpenApi\Model\Objects\Recurring;

use Tpay\OpenApi\Model\Fields\Boolean;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\BlikModel;
use Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument\RecommendedAuthLevel;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikPaymentDetails extends Objects
{
    const OBJECT_FIELDS = [
        'model' => BlikModel::class,
        'noDelay' => Boolean::class,
        'recommendedAuthLevel' => RecommendedAuthLevel::class,
    ];

    /** @var BlikModel */
    public $model;

    /** @var \Tpay\OpenApi\Model\Fields\Boolean */
    public $noDelay;

    /** @var RecommendedAuthLevel */
    public $recommendedAuthLevel;

    public function getRequiredFields()
    {
        return [
            $this->model,
        ];
    }
}
