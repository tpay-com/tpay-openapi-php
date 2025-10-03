<?php

namespace Tpay\OpenApi\Factory;

use InvalidArgumentException;
use Tpay\OpenApi\Model\Objects\Accounts\Address as AccountAddress;
use Tpay\OpenApi\Model\Objects\Accounts\Person;
use Tpay\OpenApi\Model\Objects\Accounts\PointOfSale as AccountPointOfSale;
use Tpay\OpenApi\Model\Objects\Merchant\Address as MerchantAddress;
use Tpay\OpenApi\Model\Objects\Merchant\ContactPerson;
use Tpay\OpenApi\Model\Objects\Merchant\PointOfSale as MerchantPointOfSale;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\RequestBody\Account;
use Tpay\OpenApi\Model\Objects\RequestBody\Merchant;

class ArrayObjectFactory
{
    public function create($fieldName, $parentObject)
    {
        if (!$parentObject instanceof Objects) {
            throw new InvalidArgumentException(sprintf(
                'Parent object must extend %s, got %s',
                Objects::class,
                is_object($parentObject) ? get_class($parentObject) : gettype($parentObject)
            ));
        }

        if ($parentObject instanceof Merchant) {
            switch ($fieldName) {
                case 'address':
                    return new MerchantAddress();
                case 'website':
                    return new MerchantPointOfSale();
                case 'contactPerson':
                    return new ContactPerson();
            }
        }

        if ($parentObject instanceof Account) {
            switch ($fieldName) {
                case 'address':
                    return new AccountAddress();
                case 'website':
                    return new AccountPointOfSale();
                case 'person':
                    return new Person();
            }
        }

        throw new InvalidArgumentException(sprintf('Field %s as array is not supported in %s object', $fieldName, $parentObject->getName()));
    }
}