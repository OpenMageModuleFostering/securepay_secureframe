<?php
class SecurePay_SecureFrame_Model_Standard extends Mage_Payment_Model_Method_Abstract {
	protected $_code = 'secureframe';
	
	protected $_canAuthorize            = true;
    protected $_canCapture              = true;
    protected $_canCapturePartial       = false;
    protected $_canRefund               = false;
    protected $_canRefundInvoicePartial = false;
    protected $_canVoid                 = false;
    protected $_canUseInternal          = true;
    protected $_canUseCheckout          = true;
    protected $_canUseForMultishipping  = false;
    protected $_canSaveCc               = false;
    protected $_isInitializeNeeded      = true;
	
	public function getOrderPlaceRedirectUrl() {
		return Mage::getUrl('secureframe/payment/redirect', array('_secure' => true));
	}

	public function capture(Varien_Object $payment, $amount)
    {
    }

    public function authorize(Varien_Object $payment, $amount)
    {
    }
    
    /**
     * Check method for processing with base currency
     *
     * @param string $currencyCode
     * @return boolean
     */
    public function canUseForCurrency($currencyCode)
    {
    	$currency_accepted = $this->getConfigData('currency_accepted');
    	if ($currency_accepted == "M" || ($currency_accepted == "A" && $currencyCode == "AUD")) {
    		return true;
    	}
    	return false;
    }

    /**
     * Instantiate state and set it to state object
     * @param string $paymentAction
     * @param Varien_Object
     */
    public function initialize($paymentAction, $stateObject)
    {
        $state = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
        $stateObject->setState($state);
        $stateObject->setStatus('pending_payment');
        $stateObject->setIsNotified(false);
    }
}
?>