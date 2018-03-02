<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MSP\NotifierEventApi\Api\Data\RuleInterface;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class Rule extends AbstractDb
{
    const TABLE_NAME = 'msp_notifier_event_rule';

    protected function _construct()
    {
        $this->_init(
            self::TABLE_NAME,
            RuleInterface::ID
        );
    }
}
