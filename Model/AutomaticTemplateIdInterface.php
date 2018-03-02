<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use MSP\NotifierEventApi\Api\Data\RuleInterface;

/**
 * Automatic template selector  (Service Provider Interface - SPI)
 *
 * @api
 */
interface AutomaticTemplateIdInterface
{
    const AUTOMATIC_TEMPLATE_ID = '*';

    /**
     * Return a template ID
     * @param RuleInterface $rule
     * @param string $eventName
     * @param array $data
     * @return string
     */
    public function execute(RuleInterface $rule, string $eventName, array $data = []): string;
}
