<?php

namespace Tpay\Dictionary;

class HttpCodesDictionary
{
    /**
     * List of http response codes
     */
    const HTTP_SUCCESS_CODES = [
        200 => 'OK - default successful outcome of the request',
        201 => 'Created - successfully created a new object',
        202 => 'Accepted - successfully created a new object, but requires further action',
    ];

    const HTTP_ERROR_CODES = [
        400 => 'Bad Request - request could not be accepted, either due to missing required parameters or one of the
         parameters not passing through validation',
        401 => 'Unatuhorized - authorization failed, the request has not been applied because it lacks valid
         authentication credentials for the target resource',
        403 => 'Forbidden - authorization access scope does not allow to fulfill this operation',
        404 => 'Not Found - object with requested ID could not be found',
        405 => 'Method Not Allowed - request is not supported for the path, for example attempting to use POST on list
         endpoint that doesn\'t allow creating a new object',
        409 => 'Conflict - conflict with existing objects, for example attempting to create two objects with the same
         data, or executing two incompatible operations on a single object',
    ];
}
