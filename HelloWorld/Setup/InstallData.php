<?php
namespace Orange\HelloWorld\Setup;

use Magento\Framework\Setup\InstallDataInterface;       // this is for install data (or) attrubute
use Magento\Framework\Setup\ModuleContextInterface;     // this is for install data (or) attrubute
use Magento\Framework\Setup\ModuleDataSetupInterface;   // this is for install data (or) attrubute

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

use Magento\Eav\Model\Config; // for customer attribute
use Magento\Customer\Model\Customer; // for customer attribute

class InstallData implements InstallDataInterface
{
		protected $_postFactory;

		private $eavSetupFactory;

		private $customerSetupFactory;

		private $attributeSetFactory;


		public function __construct(
	    CustomerSetupFactory $customerSetupFactory,
	    \Orange\HelloWorld\Model\PostFactory $postFactory,
	    EavSetupFactory $eavSetupFactory,
	    AttributeSetFactory $attributeSetFactory,
	    Config $eavConfig)
		{
		  $this->customerSetupFactory = $customerSetupFactory;
			$this->_postFactory = $postFactory;
		  $this->eavSetupFactory = $eavSetupFactory;
		  $this->attributeSetFactory = $attributeSetFactory;
		  $this->eavConfig       = $eavConfig;
		}
		public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
		{
	      // Install sample data
	      $data = [
	         'name'  => "Test User"
	      ];
	      $post = $this->_postFactory->create();
	      $post->addData($data)->save();

	      // add product attribute
	      $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
				$eavSetup->addAttribute(
					\Magento\Catalog\Model\Product::ENTITY,
					'sample_attribute',
					[
						'type' => 'text',
						'backend' => '',
						'frontend' => '',
						'label' => 'Sample Atrribute',
						'input' => 'text',
						'class' => '',
						'source' => '',
						'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
						'visible' => true,
						'required' => true,
						'user_defined' => false,
						'default' => '',
						'searchable' => false,
						'filterable' => false,
						'comparable' => false,
						'visible_on_front' => false,
						'used_in_product_listing' => true,
						'unique' => false,
						'apply_to' => ''
					]
				);

				// add a category attribute to save need to add a vendore/company/view/adminhtml/ui_component/category_form.xml
				$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

				$eavSetup->addAttribute(
					\Magento\Catalog\Model\Category::ENTITY,
					'category_manager',
					[
						'type'         => 'varchar',
						'label'        => 'Category Manager',
						'input'        => 'text',
						'sort_order'   => 100,
						'source'       => '',
						'global'       => 1,
						'visible'      => true,
						'required'     => false,
						'user_defined' => false,
						'default'      => null,
						'group'        => '',
						'backend'      => ''
					]
				);

				/** @var CustomerSetup $customerSetup */
				 $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
				 $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
				 $attributeSetId = $customerEntity->getDefaultAttributeSetId();
				 /** @var $attributeSet AttributeSet */
				 $attributeSet = $this->attributeSetFactory->create();
				 $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
				 $customerSetup->addAttribute(Customer::ENTITY, 'mobile2', [
						 'type' => 'varchar',
						 'label' => 'Mobile2',
						 'input' => 'text',
						 'required' => false,
						 'visible' => true,
						 'user_defined' => true,
						 'position' =>999,
						 'system' => 0,
				 ]);
				 $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'mobile2')
				 ->addData([
						 'attribute_set_id' => $attributeSetId,
						 'attribute_group_id' => $attributeGroupId,
						 'used_in_forms' => ['adminhtml_customer'],//you can use other forms also ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
				 ]);
				 $attribute->save();

				 // Customer address attribute
				/** @var CustomerSetup $customerSetup */
	      $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
	      $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer_address');
	      $attributeSetId = $customerEntity->getDefaultAttributeSetId();
	      /** @var $attributeSet AttributeSet */
	      $attributeSet = $this->attributeSetFactory->create();
	      $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
				$customerSetup->addAttribute('customer_address', 'village2', [
	          'type' => 'varchar',
	          'label' => 'Village2',
	          'input' => 'text',
	          'required' => false,
	          'visible' => true,
	          'user_defined' => true,
	          'sort_order' => 1000,
	          'position' => 1000,
	          'system' => 0,
	      ]);
				$attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'village2')
	      ->addData([
	          'attribute_set_id' => $attributeSetId,
	          'attribute_group_id' => $attributeGroupId,
	          'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
	      ]);
	      $attribute->save();
		}
}
