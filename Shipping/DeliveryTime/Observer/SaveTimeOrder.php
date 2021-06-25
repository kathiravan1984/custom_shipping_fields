<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare (strict_types = 1);

namespace Shipping\DeliveryTime\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Assign order to customer created after issuing guest order.
 */
class SaveTimeOrder implements ObserverInterface
{

    /**
     * @inheritdoc
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setData('delivery_time', $quote->getDeliveryTime());
        return $this;
    }
}
