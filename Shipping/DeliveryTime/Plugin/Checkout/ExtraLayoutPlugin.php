<?php

namespace Shipping\DeliveryTime\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;
use Psr\Log\LoggerInterface;

class ExtraLayoutPlugin
{
    protected $logger;
    protected $helper;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function afterProcess(LayoutProcessor $subject, array $jsLayout)
    {
        $extraField = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'id' => 'delivery_time',
                'tooltip' => [
                    'description' => 'Delivery Time',
                ],
            ],

            'dataScope' => 'shippingAddress.delivery_time',
            'label' => 'Delivery Time',
            'provider' => 'checkoutProvider',
            'sortOrder' => 2,
            'validation' => [
                'required-entry' => true,
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true
 
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_time'] = $extraField;

        return $jsLayout;
    }
}
