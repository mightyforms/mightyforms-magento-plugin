<?php
namespace Porthas\MightyForms\Block\Adminhtml;

use Magento\Backend\Block\Template;

class Forms extends Template
{

    protected $_httpClientFactory;

    public function __construct(
        \Magento\Framework\HTTP\ZendClientFactory $httpClientFactory
    ) {
        $this->_httpClientFactory = $httpClientFactory;
    }

    private static function getConnectionWithAttributes()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('mightyforms_api_key');

        return ['connection' => $connection, 'table_name' => $tableName];
    }


    private static function getUserApiKey()
    {
        $connectionWithAttrs = self::getConnectionWithAttributes();

        $result = $connectionWithAttrs['connection']
            ->fetchRow("SELECT `api_key` FROM `" . $connectionWithAttrs['table_name'] . "` WHERE id = 1");

        return $result['api_key'] ? $result['api_key'] : false;
    }


    /** Return list with forms
     * @return string
     * @throws \Zend_Http_Client_Exception
     */
    public function getFormsList(){

        try {

            $apiKeyFromDb = self::getUserApiKey();

            if ($apiKeyFromDb === false || strlen($apiKeyFromDb) < 16) {
                throw new \Exception('Please, go to MightyForms in main menu, then Application and sign in or sign up first');
            }

            $client = $this->_httpClientFactory->create();
            $client->setUri('https://app.mightyforms.com/api/v1/mf/' . $apiKeyFromDb . '/forms');
            $client->setMethod(\Zend_Http_Client::GET);

            $response = $client->request();

            return $response->getBody();
        }catch (\Exception $exception){
            return '{"success":false, "error":"' . $exception->getMessage() . '"}';
        }
    }

}
