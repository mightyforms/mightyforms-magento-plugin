<?php
namespace Porthas\MightyForms\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Porthas\MightyForms\Controller\Adminhtml\ApiKey\Index;

class Forms extends Template
{

    protected $_httpClientFactory;

    public function __construct(
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory
    ) {
        $this->_httpClientFactory = $httpClientFactory;
    }

    public function getFormsList(){

        $apiKeyFromDb = Index::getUserApiKey();

        if ($apiKeyFromDb === false || strlen($apiKeyFromDb) < 16) {
            throw new \Exception('Please, go to Application and sign in or sign up first');
        }

        $client = $this->_httpClientFactory->create();
        $client->setUri('https://app.mightyforms.com/api/v1/mf/' . $apiKeyFromDb . '/forms');
        $client->setMethod(\Zend_Http_Client::GET);

        $response = $client->request();

        return $response->getBody();
    }

}