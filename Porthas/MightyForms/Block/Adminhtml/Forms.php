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

    /**
     * @return string
     * @throws \Zend_Http_Client_Exception
     */
    public function getFormsList(){

        try {

            $apiKeyFromDb = Index::getUserApiKey();

            if ($apiKeyFromDb === false || strlen($apiKeyFromDb) < 16) {
                throw new \Exception('Please, go to Application and sign in or sign up first');
            }

            $client = $this->_httpClientFactory->create();
            $client->setUri('http://localhost:3000/api/v1/mf/' . $apiKeyFromDb . '/forms');
            $client->setMethod(\Zend_Http_Client::GET);

            $response = $client->request();

            return $response->getBody();
        }catch (\Exception $exception){
            return '{"success":false, "error":"' . $exception->getMessage() . '"}';
        }
    }

}