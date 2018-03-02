<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\ResourceModel\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = \MSP\NotifierEventApi\Api\Data\RuleInterface::ID;

    protected function _construct()
    {
        $this->_init(
            \MSP\NotifierEvent\Model\Rule::class,
            \MSP\NotifierEvent\Model\ResourceModel\Rule::class
        );
    }
}
