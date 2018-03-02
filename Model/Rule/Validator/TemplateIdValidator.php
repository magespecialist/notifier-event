<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Validator;

use MSP\NotifierEvent\Model\AutomaticTemplateIdInterface;
use MSP\NotifierEventApi\Api\Data\RuleInterface;
use MSP\NotifierTemplate\Model\TemplateGetter\TemplateGetterInterface;

class TemplateIdValidator implements RuleValidatorInterface
{
    /**
     * @var TemplateGetterInterface
     */
    private $templateGetter;

    public function __construct(
        TemplateGetterInterface $templateGetter
    ) {
        $this->templateGetter = $templateGetter;
    }

    /**
     * Execute validation. Return true on success or trigger an exception on failure
     * @param RuleInterface $rule
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(RuleInterface $rule): bool
    {
        if ($rule->getTemplateId() === AutomaticTemplateIdInterface::AUTOMATIC_TEMPLATE_ID) {
            return true;
        }

        if (!trim($rule->getTemplateId())) {
            throw new \InvalidArgumentException('' . __('Template is required'));
        }

        $template = $this->templateGetter->getTemplate('', $rule->getTemplateId());
        if (!$template) {
            throw new \InvalidArgumentException('' . __('Invalid template %1', $rule->getTemplateId()));
        }

        return true;
    }
}
