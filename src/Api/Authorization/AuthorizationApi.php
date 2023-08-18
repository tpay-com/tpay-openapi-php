<?php

namespace Tpay\Api\Authorization;

use Tpay\Api\ApiAction;
use Tpay\Model\Objects\RequestBody\Auth;

class AuthorizationApi extends ApiAction
{
    public function getNewToken($fields)
    {
        return $this->run(static::POST, '/oauth/auth', $fields, new Auth());
    }

    public function getTokenInfo()
    {
        return $this->run(static::GET, '/oauth/tokeninfo');
    }
}
