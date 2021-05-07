<?php

namespace Orange\OrderGridMap\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->addColumn( 
           $setup->getTable('sales_order_grid'), 
           'custom_field', 
           [
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 
               'length' => 255, 
               'nullable' => true, 
               'comment' => 'Custom Field' 
           ]
        );
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('affiliate')) {
                $table = $installer->getConnection()->newTable(
                        $installer->getTable('affiliate')
                )
                ->addColumn(
                    'order_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true, 
                    ],
                    'Order Id'
                )
                ->addColumn(
                'affiliate_information',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Affiliate Information'
            )
            ->setComment('Affiliate');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
