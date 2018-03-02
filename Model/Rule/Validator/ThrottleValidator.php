<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Validator;

use MSP\NotifierEventApi\Api\Data\RuleInterface;

class ThrottleValidator implements RuleValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param RuleInterface $rule
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(RuleInterface $rule): bool
    {
        if ($rule->getThrottleInterval() < 0) {
            throw new \InvalidArgumentException('' . __('Throttle interval must be greater or equal to 0'));
        }

        if ($rule->getThrottleLimit() < 0) {
            throw new \InvalidArgumentException('' . __('Throttle limit must be greater or equal to 0'));
        }

        return true;
    }
}
