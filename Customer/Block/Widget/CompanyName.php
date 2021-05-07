<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Orange\Customer\Block\Widget;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\OptionInterface;

/**
 * Block to render customer's comany_name attribute
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class CompanyName extends \Magento\Customer\Block\Widget\AbstractWidget
{   
    /**
    * @var \Magento\Customer\Model\Session
    */
   protected $_customerSession;

   /**
    * @var CustomerRepositoryInterface
    */
   protected $customerRepository;

   /**
    * Create an instance of the Gender widget
    *
    * @param \Magento\Framework\View\Element\Template\Context $context
    * @param \Magento\Customer\Helper\Address $addressHelper
    * @param CustomerMetadataInterface $customerMetadata
    * @param CustomerRepositoryInterface $customerRepository
    * @param \Magento\Customer\Model\Session $customerSession
    * @param array $data
    */
   
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Address $addressHelper,
        CustomerMetadataInterface $customerMetadata,
        CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $addressHelper, $customerMetadata, $data);
        $this->_isScopePrivate = true;
    }
    
    /**
     * Initialize block
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/companyname.phtml');
    }
    
    /**
     * @return bool
     */
    public function isEnabled() {
        $attributeMetadata = $this->_getAttribute('company_name');
        return $attributeMetadata ? (bool) $attributeMetadata->isVisible() : false;
    }
    
    /**
     * Check if gender attribute marked as required
     * @return bool
     */
    public function isRequired()
    {
        return $this->_getAttribute('company_name') ? (bool)$this->_getAttribute('company_name')->isRequired() : false;
    }
    
    /**
     * Get current customer from session
     *
     * @return CustomerInterface
     */
    public function getCustomer()
    {
        return $this->customerRepository->getById($this->_customerSession->getCustomerId());
    }
}

?>