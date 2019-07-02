<?php

namespace Porthas\MightyForms\Controller\Adminhtml\Apikey;


class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        if($this->getRequest()->isAjax()){
            echo '{"some_key": "some_value"}';
        }
    }
}