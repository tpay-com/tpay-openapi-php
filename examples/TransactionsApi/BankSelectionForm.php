<?php

namespace Tpay\Example\TransactionsApi;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Forms\PaymentForms;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\TpayException;

final class BankSelectionForm extends ExamplesConfig
{
    public function getBankForm()
    {
        $PaymentForms = new PaymentForms('en');
        $form = $PaymentForms->getBankSelectionForm(
            $this->getBanksList(true),
            false,
            true,
            'RedirectPayment.php',
            false
        );
        echo $form;
    }

    protected function getBanksList($onlineOnly = false)
    {
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $TpayApi = new TpayApi($cache, self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, true, 'read');
        $result = $TpayApi->transactions()->getBankGroups($onlineOnly);
        if (!isset($result['result']) || 'success' !== $result['result']) {
            throw new TpayException('Unable to get banks list. Response: '.json_encode($result));
        }

        return $result['groups'];
    }
}
(new BankSelectionForm())->getBankForm();
