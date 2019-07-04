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

    /**
     * @return array
     */
    private static function getConnectionWithAttributes()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('mightyforms_api_key');

        return ['connection' => $connection, 'table_name' => $tableName];
    }

    /** This functoin called from frontend via ajax,
     *  and pass api_key from iFrame (postMessage) to DB
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if ($this->getRequest()->isAjax()) {

            if ($this->getRequest()->getParam('apiKey')) {

                $rawUserApiKey = $this->getRequest()->getParam('apiKey');
                // clean, escape and trim user Api key before insert into DB.
                $userApiKey = htmlspecialchars(trim(addslashes($rawUserApiKey)));

                $connectionWithAttrs = self::getConnectionWithAttributes();

                // Check is api key already exist. So, we need to decide insert new or update existing key.
                $userApiKeyFromDd = self::getUserApiKey();

                if($userApiKeyFromDd) {

                    $sql = "UPDATE " . $connectionWithAttrs['table_name'] . " SET `api_key` = '" . $userApiKey . "' WHERE id = 1";

                }else{

                    $sql = "INSERT INTO " . $connectionWithAttrs['table_name'] . " (`id`, `api_key`) VALUES (1, '" . $userApiKey . "')";

                }

                $connectionWithAttrs['connection']->query($sql);
            }
        }
    }

    /**
     * @return bool|mixed
     */
    public static function getUserApiKey()
    {
        $connectionWithAttrs = self::getConnectionWithAttributes();

        $result = $connectionWithAttrs['connection']
            ->fetchRow("SELECT `api_key` FROM `" . $connectionWithAttrs['table_name'] . "` WHERE id = 1");

        return $result['api_key'] ? $result['api_key'] : false;

    }
}

