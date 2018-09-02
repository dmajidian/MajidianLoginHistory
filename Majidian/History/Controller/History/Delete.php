<?php

namespace Majidian\History\Controller\History;

class Delete extends \Majidian\History\Controller\History
{
    protected $transportBuilder;
    protected $scopeConfig;
    protected $storeManager;
    protected $formKeyValidator;
    protected $dateTime;
    protected $historyFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \Majidian\History\Model\HistoryFactory $historyFactory
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->dateTime = $dateTime;
        $this->historyFactory = $historyFactory;
        parent::__construct($context, $customerSession);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            return $resultRedirect->setRefererUrl();
        }

        $deleteIds = $this->getRequest()->getParam('id');

        try {

            foreach($deleteIds as $id)
            {
                $history = $this->historyFactory->create();
                $history->load($id);
                $history->delete();
            }

            $this->messageManager->addSuccess(__('History deleted.'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error occurred while deleting history.'));
        }

        return $resultRedirect->setRefererUrl();
    }
}