<?php

namespace Tpay\OpenApi\Api\Blik;

use Tpay\OpenApi\Api\ApiAction;
use Tpay\OpenApi\Model\Objects\RequestBody\CreateAlias;
use Tpay\OpenApi\Model\Objects\RequestBody\DeleteAlias;

class BlikApi extends ApiAction
{
    /** @param array $fields */
    public function createAlias($fields)
    {
        return $this->run(static::POST, '/blik/alias', $fields, new CreateAlias());
    }

    /**
     * @param string $aliasValue
     * @param string $aliasType
     */
    public function getAlias($aliasValue, $aliasType)
    {
        $requestUrl = $this->addQueryFields(
            sprintf('/blik/alias/%s', $aliasValue),
            ['aliasType' => $aliasType]
        );

        return $this->run(static::GET, $requestUrl);
    }

    /**
     * @param string $aliasValue
     * @param array  $fields
     */
    public function deleteAlias($aliasValue, $fields)
    {
        return $this->run(static::DELETE, sprintf('/blik/alias/%s', $aliasValue), $fields, new DeleteAlias());
    }
}
