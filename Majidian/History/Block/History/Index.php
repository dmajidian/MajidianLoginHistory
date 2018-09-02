<?php

namespace Majidian\History\Block\History;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $dateTime;
    protected $customerSession;
    protected $historyFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \Magento\Customer\Model\Session $customerSession,
        \Majidian\History\Model\HistoryFactory $historyFactory
    )
    {
        $this->dateTime = $dateTime;
        $this->customerSession = $customerSession;
        $this->historyFactory = $historyFactory;
        parent::__construct($context);

        $col = isset($_GET['col']) ? $_GET['col'] : 'history_id';
        $dir = isset($_GET['dir']) ? $_GET['dir'] : 'asc';

        $collection = $this->historyFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->customerSession->getCustomerId())
            ->setOrder($col,$dir);
        $this->setCollection($collection);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'majidian.history.list.pager'
        );
        $limit = (isset($_GET['limit']) && $_GET['limit'] > 0) ? $_GET['limit'] : 10;

        $pager
            ->setShowPerPage(true)
            ->setLimit($limit)
            ->setCollection($this->getCollection());
        $this->setChild('pager', $pager);

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
