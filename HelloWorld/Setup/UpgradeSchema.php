<?php
namespace Orange\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.0.0', '<')) {
            if (!$installer->tableExists('orange_helloworld_post')) {
                $table = $installer->getConnection()->newTable(
                        $installer->getTable('orange_helloworld_post')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                                'identity' => true,
                                'nullable' => false,
                                'primary'  => true,
                                'unsigned' => true,
                        ],
                        'ID'
                    )
                    ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Name'
                )
                ->setComment('CURD Table');
                $installer->getConnection()->createTable($table);
            }
        }
        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable( 'orange_helloworld_post' ),
                'age',
                [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        'nullable' => true,
                        'length' => '12,4',
                        'comment' => 'Age',
                        'after' => 'name'
                ]
            );
        }
        $installer->endSetup();
    }
}
