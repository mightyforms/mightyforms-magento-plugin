<?php
namespace Porthas\MightyForms\Block;

class EmbeddedBlock extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function renderForm()
    {
        return '<!-- MightyForms Section -->
        <div class="mighty-form" id="mf-' . $this->getData('form_id') . '"></div>';
    }
}