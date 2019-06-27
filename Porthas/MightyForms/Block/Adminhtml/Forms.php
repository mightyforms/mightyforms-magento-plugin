<?php
namespace Porthas\MightyForms\Block\Adminhtml;

use Magento\Backend\Block\Template;

class Forms extends Template
{

    protected $_httpClientFactory;

    public function __construct(
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory
    ) {
        $this->_httpClientFactory   = $httpClientFactory;
    }


    public function getUserApiKey()
    {
        return 'uIj9fKlMPuBmXlY9';
    }

    public function getFormsList(){

        $client = $this->_httpClientFactory->create();
        $client->setUri('https://app.mightyforms.com/api/v1/mf/' . $this->getUserApiKey() . '/forms');
        $client->setMethod(\Zend_Http_Client::GET);

        $response= $client->request();

        return $response->getBody();
    }

    public function handleShortcode(){

    }
}