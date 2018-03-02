<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Setup\Operation;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use MSP\Notifier\Setup\Operation\CreateChannelTable;

class CreateRuleTable
{
    const TABLE_NAME_RULE = 'msp_notifier_event_rule';

    /**
     * @param SchemaSetupInterface $setup
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function execute(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(self::TABLE_NAME_RULE)
        )->setComment(
            'MSP Notifier Rule Table'
        );

        $table = $this->addFields($table);

        $setup->getConnection()->createTable($table);
    }

    /**
     * Add fields
     * @param Table $table
     * @return Table
     * @throws \Zend_Db_Exception
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function addFields(Table $table): Table
    {
        $table
            ->addColumn(
                'rule_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true,
                ],
                'Rule ID'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Rule name'
            )
            ->addColumn(
                'events',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Connected events'
            )
            ->addColumn(
                'template_id',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Template ID'
            )
            ->addColumn(
                'channels_codes',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Alert channels codes'
            )
            ->addColumn(
                'enabled',
                Table::TYPE_BOOLEAN,
                null,
                [
                    'nullable' => false,
                ],
                'Rule enabled'
            )
            ->addColumn(
                'throttle_limit',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Throttle limit'
            )
            ->addColumn(
                'throttle_interval',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Throttle interval'
            )
            ->addColumn(
                'last_fired_at',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => true,
                ],
                'Last time the rule was fired'
            )
            ->addColumn(
                'fire_count',
                Table::TYPE_INTEGER,
                null,
                [
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Rule fire count'
            );

        return $table;
    }
}
