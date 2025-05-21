<?php

namespace Tpay\OpenApi\Model\Fields;

interface FieldTypes
{
    public const STRING = 'string';
    public const INT = 'integer';
    public const BOOL = 'boolean';
    public const NUMBER = 'number';
    public const FIELD_TYPES = [
        self::STRING,
        self::INT,
        self::BOOL,
        self::NUMBER,
    ];
}
