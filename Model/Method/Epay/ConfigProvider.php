<?php
/**
 * Copyright (c) 2017. All rights reserved Duitku Linkajapercent.
 *
 * This program is free software. You are allowed to use the software but NOT allowed to modify the software.
 * It is also not legal to do any changes to the software and distribute it in your own name / brand.
 *
 * All use of the payment modules happens at your own risk. We offer a free test account that you can use to test the module.
 *
 * @author    Duitku Linkajapercent
 * @copyright Duitku Linkajapercent (http://duitku.com)
 * @license   Duitku Linkajapercent
 *
 */
namespace Duitku\Linkajapercent\Model\Method\Epay;

use \Duitku\Linkajapercent\Model\Method\Epay\Payment as EpayPayment;
use \Duitku\Linkajapercent\Helper\DuitkuConstants;

class ConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface
{
    /**
     * @var string
     */
    protected $methodCode = EpayPayment::METHOD_CODE;

    /**
     * @var Object
     */
    protected $_ePayMethod;

    /**
     * @var \Magento\Payment\Helper\Data
     */
    protected $_paymentHelper;

    /**
     * Config Provider
     *
     * @param \Magento\Payment\Helper\Data $paymentHelper
     */
    public function __construct(
        \Magento\Payment\Helper\Data $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_ePayMethod = $this->_paymentHelper->getMethodInstance($this->methodCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                 $this->methodCode => [
                    'paymentTitle' => $this->_ePayMethod->getConfigData(DuitkuConstants::TITLE),
                    'checkoutUrl'=> $this->_ePayMethod->getCheckoutUrl(),
                    'cancelUrl'=> $this->_ePayMethod->getCancelUrl()
                ]
            ]
        ];

        return $config;
    }
    
}
