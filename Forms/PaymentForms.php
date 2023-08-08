<?php

namespace tpaySDK\Forms;

use tpaySDK\Utilities\Util;

class PaymentForms
{
    /**
     * @var string
     */
    const PAYMENT_FORM = 'paymentForm';

    const TPAY_TERMS_OF_SERVICE_URL = 'https://secure.tpay.com/regulamin.pdf';

    public function __construct($language = 'en')
    {
        Util::setLanguage($language);
    }

    /**
     * Create HTML form for payment with BLIK code
     *
     * @param string $formActionUrl the form will be submitted to this url
     *
     * @return string
     */
    public function getBlikCodeForm($formActionUrl)
    {
        $data = [
            'regulation_url' => static::TPAY_TERMS_OF_SERVICE_URL,
            'action_url' => $formActionUrl,
        ];

        return Util::parseTemplate('blikForm', $data);
    }

    /**
     * Create HTML form allowing the client to choose his payment method
     *
     * @param array  $groupsList      list of bank groups downloaded with GET /transactions/bank-groups
     * @param bool   $smallList       type of bank selection - icons grid or small select
     * @param bool   $showRegulations show accept regulations input
     * @param string $actionURL       sets non default action URL of form
     * @param bool   $isSimple        set true to do not show header and payment button.
     *                                You can use this to code your own handling of bank choice
     *
     * @see https://openapi.tpay.com/#/transactions/get_transactions_bank_groups
     *
     * @return string HTML form
     */
    public function getBankSelectionForm(
        $groupsList,
        $smallList = false,
        $showRegulations = true,
        $actionURL = '',
        $isSimple = false
    ) {
        $data = [
            'action_url' => $actionURL,
            'show_regulations_checkbox' => $showRegulations,
            'regulation_url' => static::TPAY_TERMS_OF_SERVICE_URL,
            'groups_list' => $groupsList,
            'small_list' => $smallList,
            'is_simple' => $isSimple,
        ];

        return Util::parseTemplate('bankSelection', $data);
    }

    /**
     * Get HTML form for direct sale gate. Using for payment in merchant shop
     *
     * @param string $RsaKey              from merchant panel used for credit card encryption
     * @param string $paymentRedirectPath payment redirect path
     * @param bool   $cardSaveAllowed     set true if your want to display the save card checkbox
     * @param bool   $payerFields         set true if you want to display the name and email fields in card form.
     *                                    Otherwise you will need to get those values from your DataBase.
     * @param array  $savedCards          list of user saved cards. Must contain id, shortCode and vendor parameters
     *
     * @return string
     */
    public function getOnSiteCardForm(
        $RsaKey,
        $paymentRedirectPath = '',
        $cardSaveAllowed = true,
        $payerFields = true,
        $savedCards = []
    ) {
        $data = [
            'rsa_key' => $RsaKey,
            'payment_redirect_path' => $paymentRedirectPath,
            'card_save_allowed' => $cardSaveAllowed,
            'showPayerFields' => $payerFields,
            'userCards' => $savedCards,
            'regulation_url' => static::TPAY_TERMS_OF_SERVICE_URL,
        ];
        $data['new_card_form'] = Util::parseTemplate('gate', $data);

        return Util::parseTemplate('savedCardForm', $data);
    }
}
