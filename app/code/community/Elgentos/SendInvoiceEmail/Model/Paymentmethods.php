<?php

class Elgentos_SendInvoiceEmail_Model_Paymentmethods
{

    public function toOptionArray()
    {
        $payments = Mage::getSingleton('payment/config')->getAllMethods();

        $methods = array(array('value' => '', 'label' => ''));

        foreach ($payments as $paymentCode=>$paymentModel) {
            $paymentTitle = Mage::getStoreConfig('payment/'.$paymentCode.'/title');
            $methods[$paymentCode] = array(
                'label'   => ($paymentTitle ? $paymentTitle . ' (' . $paymentCode . ')' : $paymentCode),
                'value' => $paymentCode,
            );
        }

        return $methods;

    }

}