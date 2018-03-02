<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Validator;

use MSP\NotifierEventApi\Api\Data\RuleInterface;

class NameValidator implements RuleValidatorInterface
{
    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param RuleInterface $rule
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(RuleInterface $rule): bool
    {
        if (!trim($rule->getName())) {
            throw new \InvalidArgumentException('' . __('Rule name is required'));
        }

        return true;
    }
}
