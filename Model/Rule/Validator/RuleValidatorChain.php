<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Validator;

use MSP\NotifierEventApi\Api\Data\RuleInterface;

class RuleValidatorChain implements RuleValidatorInterface
{
    /**
     * @var RuleValidatorInterface[]
     */
    private $validators;

    /**
     * RuleValidatorChain constructor.
     * @param RuleValidatorInterface[] $validators
     */
    public function __construct(
        array $validators = []
    ) {
        $this->validators = $validators;

        foreach ($this->validators as $k => $validator) {
            if (!($validator instanceof RuleValidatorInterface)) {
                throw new \InvalidArgumentException('Validator %1 must implement RuleValidatorChainInterface', $k);
            }
        }
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param RuleInterface $rule
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(RuleInterface $rule): bool
    {
        foreach ($this->validators as $validator) {
            $validator->execute($rule);
        }

        return true;
    }
}
