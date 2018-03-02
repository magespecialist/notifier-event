<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Command;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Get Rule by ruleId command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Get call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \MSP\NotifierEventApi\Api\RuleRepositoryInterface
 * @api
 */
interface GetInterface
{
    /**
     * Get Rule data by given ruleId
     *
     * @param int $ruleId
     * @return \MSP\NotifierEventApi\Api\Data\RuleInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $ruleId): \MSP\NotifierEventApi\Api\Data\RuleInterface;
}
