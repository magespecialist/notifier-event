<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Command;

use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save Rule data command (Service Provider Interface - SPI)
 *
 * Separate command interface to which Repository proxies initial Save call, could be considered as SPI - Interfaces
 * that you should extend and implement to customize current behaviour, but NOT expected to be used (called) in the code
 * of business logic directly
 *
 * @see \MSP\NotifierEventApi\Api\RuleRepositoryInterface
 * @api
 */
interface SaveInterface
{
    /**
     * Save Rule data
     *
     * @param \MSP\NotifierEventApi\Api\Data\RuleInterface $source
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(\MSP\NotifierEventApi\Api\Data\RuleInterface $source): int;
}
