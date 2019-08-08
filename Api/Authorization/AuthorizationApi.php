<?php
namespace tpaySDK\Api\Authorization;

use tpaySDK\Api\ApiAction;
use tpaySDK\Model\Objects\RequestBody\Auth;

class AuthorizationApi extends ApiAction
{
    public function getNewToken($fields)
    {
        return $this->run(static::POST, '/oauth/auth', $fields, new Auth);
    }

    public function getTokenInfo()
    {
        return $this->run(static::GET, '/oauth/tokeninfo');
    }

}
