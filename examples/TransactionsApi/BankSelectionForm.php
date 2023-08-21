<?php

namespace Tpay\Example\TransactionsApi;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Forms\PaymentForms;
use Tpay\OpenApi\Utilities\TpayException;

require_once '../ExamplesConfig.php';
require_once '../../src/Loader.php';

class BankSelectionForm extends ExamplesConfig
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
        $TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
        $result = $TpayApi->Transactions->getBankGroups($onlineOnly);
        if (!isset($result['result']) || 'success' !== $result['result']) {
            throw new TpayException('Unable to get banks list. Response: '.json_encode($result));
        }

        return $result['groups'];
    }
}
(new BankSelectionForm())->getBankForm();
