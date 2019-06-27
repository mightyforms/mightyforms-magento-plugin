<?php
namespace Porthas\MightyForms\Block\Adminhtml;

use \Magento\Framework\View\Element\Template;


class PageForm extends Template
{

    public function test(){
        try {
            return "HELLO WORLD";
        } catch (\Exception $e) {
           echo $e;
        }
    }


}
