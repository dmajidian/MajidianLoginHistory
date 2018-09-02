<?php

namespace Majidian\History\Observer;

use Magento\Framework\Event\ObserverInterface;

class LogCustomerHistory implements ObserverInterface
{
    protected $historyFactory;

    public function __construct(
        \Majidian\History\Model\HistoryFactory $historyFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime
    )
    {
        $this->historyFactory = $historyFactory;
        $this->dateTime = $dateTime;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getModel();

        try {
            $history = $this->historyFactory->create();
            $history->setCustomerId($customer->getId());
            $history->setIpAddress($_SERVER['REMOTE_ADDR']);
            $history->setUserAgent($_SERVER['HTTP_USER_AGENT']);
            $history->setCreatedAt($this->dateTime->formatDate(true));
            $history->save();
        } catch (Exception $e) {
           //
        }

        return $this;
    }
}
