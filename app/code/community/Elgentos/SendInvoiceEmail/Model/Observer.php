<?php

class Elgentos_SendInvoiceEmail_Model_Observer
{
    public function sendInvoiceEmail($observer)
    {
        /**
         * @var $invoice Mage_Sales_Model_Order_Invoice
         * @var $paymentMethod Mage_Payment_Model_Method_Abstract
         */
        $invoice       = $observer->getEvent()->getInvoice();
        $paymentMethod = $observer->getEvent()->getPayment()->getMethodInstance();

        $_sendInvoiceEmailsFor = explode(',', Mage::getStoreConfig('sales_email/invoice/send_invoice_email_for_payment_methods', $invoice->getStoreId()));

        if (
            $invoice->getId()
            &&
            in_array(
                $paymentMethod->getCode(),
                $_sendInvoiceEmailsFor
            )
            &&
            !$invoice->getEmailSent()
        ) {
            $invoice->sendEmail(TRUE);
        }
    }
}