<?php

namespace Porthas\MightyForms\Controller\Adminhtml\Apikey;

class Index extends \Magento\Backend\App\Action
{
    protected $_apiKeyFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context
    )
    {
        parent::__construct($context);
    }

    private static function getConnectionWithAttributes()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('mightyforms_api_key');

        return ['connection' => $connection, 'table_name' => $tableName];
    }

    public function execute()
    {
        if ($this->getRequest()->isAjax()) {

            if ($this->getRequest()->getParam('apiKey')) {

                $rawUserApiKey = $this->getRequest()->getParam('apiKey');
                $userApiKey = htmlspecialchars(trim(addslashes($rawUserApiKey)));

                $connectionWithAttrs = self::getConnectionWithAttributes();

                $sql = "UPDATE " . $connectionWithAttrs['table_name'] . " SET `api_key` = '" . $userApiKey . "' WHERE id = 1";
                $connectionWithAttrs['connection']->query($sql);
            }
        }
    }

    public static function getUserApiKey()
    {

        $connectionWithAttrs = self::getConnectionWithAttributes();

        $result = $connectionWithAttrs['connection']
            ->fetchRow("SELECT `api_key` FROM `" . $connectionWithAttrs['table_name'] . "` WHERE id = 1");

        return $result['api_key'] ? $result['api_key'] : false;

    }
}

