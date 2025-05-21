<?php

namespace Tpay\OpenApi\Model\Fields;

interface FieldTypes
{
    const STRING = 'string';
    const INT = 'integer';
    const BOOL = 'boolean';
    const NUMBER = 'number';
    const FIELD_TYPES = [
        self::STRING,
        self::INT,
        self::BOOL,
        self::NUMBER,
    ];
}
