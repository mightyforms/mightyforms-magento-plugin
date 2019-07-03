<?php
namespace Porthas\MightyForms\Block;

class EmbededBlock extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function renderForm()
    {
//        return ' Call! ' .  $this->getData('form_id') ;
        return '<!-- MightyForms Section -->
        <div class="mighty-form" id="mf-' . $this->getData('form_id') . '"></div>';
//
    }
}