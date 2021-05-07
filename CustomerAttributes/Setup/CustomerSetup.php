<?php

namespace Orange\CustomerAttributes\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class CustomerSetup extends EavSetup {

	protected $eavConfig;

	public function __construct(
		ModuleDataSetupInterface $setup,
		Context $context,
		CacheInterface $cache,
		CollectionFactory $attrGroupCollectionFactory,
		Config $eavConfig
		) {
		$this -> eavConfig = $eavConfig;
		parent :: __construct($setup, $context, $cache, $attrGroupCollectionFactory);
	}

	public function installAttributes($customerSetup) {
		$this->installCustomerAttributes($customerSetup);
		$this->installCustomerAddressAttributes($customerSetup);
	}

	public function installCustomerAttributes($customerSetup) {
		$customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY,
			'terms_of_payment',
			[
				'label' => 'Terms Of Payment',
				'system' => 0,
				'position' => 201,
				'sort_order' =>201,
				'visible' =>  true,
				'note' => '',
				'type' => 'int',
				'input' => 'select',
				'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
				'backend' => '',
				'option' => ['values' => ['N270','N30','N300','N45','N60','N90','NET30','SAMPLE','TERMS']]
			]
			);

		$customerSetup->getEavConfig()->getAttribute('customer', 'terms_of_payment')
		->setData('is_user_defined',1)
		->setData('is_required',0)
		->setData('default_value','')
		->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])
		->save();				

		$customerSetup -> addAttribute(\Magento\Customer\Model\Customer::ENTITY,
			'allowed_brands',
			[
				'label' => 'Allowed Brands',
				'system' => 0,
				'position' => 202,
				'sort_order' =>202,
				'visible' =>  true,
				'note' => '',
				'type' => 'varchar',
				'input' => 'multiselect',
				'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
				'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
				'option' => ['values' => ['NOKIA','MI','VIVO','APPLE','SAMSUNG']]
			]
			);

		$customerSetup->getEavConfig()->getAttribute('customer', 'allowed_brands')
		->setData('is_user_defined',1)
		->setData('is_required',0)
		->setData('default_value','')
		->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])
		->save();
	}

	public function installCustomerAddressAttributes($customerSetup) {
		$customerSetup->addAttribute('customer_address',
			'mode_of_delivery',
			[
				'label' => 'Mode Of Delivery',
				'system' => 0,
				'user_defined' => true,
				'position' => 201,
				'sort_order' =>201,
				'visible' =>  true,
				'default_value' => '',
				'note' => '',
				'type' => 'int',
				'input' => 'select',
				'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
				'backend' => '',
				'option' => ['values' => ['FDX2','FDX3','PICKUP','UPS','UPS1','UPS1AM','UPS1SVR']]
			]
		);

		$customerSetup->getEavConfig()
		->getAttribute('customer_address', 'mode_of_delivery')
		->setData('is_required',0)
		->setData('attribute_set_id',2)
		->setData('attribute_group_id',2)
		->setData('is_user_defined',1)->setData('default_value','')
		->setData('used_in_forms', ['adminhtml_customer_address', 'customer_register_address', 'customer_address_edit'])
		->save();
	}

	public function getEavConfig() {
		return $this->eavConfig;
	}
} 