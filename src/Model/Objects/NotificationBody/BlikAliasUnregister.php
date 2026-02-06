<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Event;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Id;
use Tpay\OpenApi\Model\Fields\Notification\Md5sum;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias\BlikAliasUnregisterItem;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikAliasUnregister extends Objects
{
    const OBJECT_FIELDS = [
        'id' => Id::class,
        'event' => Event::class,
        'msg_value' => [BlikAliasUnregisterItem::class],
        'md5sum' => Md5sum::class,
    ];

    /** @var Id */
    public $id;

    /** @var Event */
    public $event;

    /** @var BlikAliasUnregisterItem */
    public $msg_value;

    /** @var Md5sum */
    public $md5sum;

    public function getRequiredFields()
    {
        return [
            $this->id,
            $this->event,
            $this->msg_value,
        ];
    }
}
