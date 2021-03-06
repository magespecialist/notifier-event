<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

/**
 * Capture event (Service Provider Interface - SPI)
 * This is the main entry point of any new incoming event to be trapped by MSP Notifier
 *
 * @api
 */
interface CaptureEventInterface
{
    /**
     * Capture event and return true if handled
     * @param string $eventName
     * @param array $data
     * @return bool
     */
    public function execute(string $eventName, array $data = []): bool;
}
