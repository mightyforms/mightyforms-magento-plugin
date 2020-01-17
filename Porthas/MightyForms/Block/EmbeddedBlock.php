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

        phpinfo();
        return
            '<!-- MightyForms Section -->
                <script src="https://form.mightyforms.com/loader/v1/mightyforms.min.js"></script>
                <div class="mighty-form" id="mf-' . $this->getData('form_id') . '"></div>
            <!-- MightyForms Section -->';
    }
}