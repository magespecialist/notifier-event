<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierEvent\Model\Source\Rule\Template;
use MSP\NotifierEventApi\Api\Data\RuleInterface;
use MSP\NotifierTemplate\Model\TemplateGetter\TemplateGetterInterface;

class AutomaticTemplateId implements AutomaticTemplateIdInterface
{
    const DEFAULT_TEMPLATE = 'event:_default';

    /**
     * @var TemplateGetterInterface
     */
    private $templateGetterPool;

    public function __construct(
        TemplateGetterInterface $templateGetterPool
    ) {
        $this->templateGetterPool = $templateGetterPool;
    }

    /**
     * Return a template ID
     * @param RuleInterface $rule
     * @param string $eventName
     * @param array $data
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(RuleInterface $rule, string $eventName, array $data = []): string
    {
        try {
            $this->templateGetterPool->getTemplate('', Template::TEMPLATE_PREFIX . $eventName);
            return Template::TEMPLATE_PREFIX . $eventName;
        } catch (NoSuchEntityException $e) {
            return self::DEFAULT_TEMPLATE;
        }
    }
}
