<?php
namespace Orange\HelloWorld\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
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
            ->setComment('Post Table');
               // echo "ssss"; exit;
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
