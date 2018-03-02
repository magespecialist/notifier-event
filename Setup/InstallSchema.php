<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MSP\NotifierEvent\Setup\Operation\CreateRuleTable;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var CreateRuleTable
     */
    private $createRuleTable;

    public function __construct(
        CreateRuleTable $createRuleTable
    ) {
        $this->createRuleTable = $createRuleTable;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createRuleTable->execute($setup);
        $setup->endSetup();
    }
}
