<?php

namespace Shipping\DeliveryTime\Plugin\Quote;

use Magento\Quote\Model\QuoteRepository;

class SaveQuotePlugin
{
    protected $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        if (!$extAttributes = $addressInformation->getExtensionAttributes()) {
            return;
        }

        $quote = $this->quoteRepository->getActive($cartId);

        $quote->setDeliveryTime($extAttributes->getDeliveryTime());
    }
}
