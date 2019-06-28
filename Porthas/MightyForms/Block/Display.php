<?php
namespace Porthas\MightyForms\Block;

class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function sayHello()
    {
        return $this->getData('project_id') . '<iframe  src="https://app.mightyforms.com"></iframe>';
    }
}