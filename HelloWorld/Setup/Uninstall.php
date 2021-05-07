<?php
namespace Orange\HelloWorld\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{       
        protected $eavSetupFactory;
        public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
        {
            $this->eavSetupFactory = $eavSetupFactory;
        }
	public function uninstall(SchemaSetupInterface $setup,ModuleContextInterface $context)
	{
		/*$installer = $setup;
		$installer->startSetup();
		$installer->getConnection()->dropTable($installer->getTable('orange_helloworld_post'));
		$installer->endSetup();
                
                $setup->startSetup();
                $eavSetup = $this->eavSetupFactory->create();
                $entityTypeId = 1; 
                $eavSetup->removeAttribute($entityTypeId, 'district');
                $setup->endSetup();*/
	}
}