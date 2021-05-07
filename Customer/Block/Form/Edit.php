<?php
namespace Orange\Customer\Block\Form;
use Magento\Framework\View\Element\Template;

class Edit extends \Magento\Customer\Block\Form\Edit
{
    public function getCompanyName() 
    { 
        return "Override Text"; 
    }
}