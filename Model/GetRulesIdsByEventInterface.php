<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

/**
 * Find Rule by linked event name (Service Provider Interface - SPI)
 *
 * Creates an internal cache for performance issues of rules matching the event name
 * do not consider this API as "pure function"
 *
 * @api
 */
interface GetRulesIdsByEventInterface
{
    /**
     * @param string $eventName
     * @return array
     */
    public function execute(string $eventName): array;
}
