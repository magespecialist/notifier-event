<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Source\Rule;

use Magento\Framework\Option\ArrayInterface;
use MSP\NotifierTemplate\Model\TemplateGetter\TemplateGetterInterface;

class Template implements ArrayInterface
{
    const TEMPLATE_PREFIX = 'event:';

    /**
     * @var TemplateGetterInterface
     */
    private $templateGetter;

    /**
     * Template constructor.
     * @param TemplateGetterInterface $templateGetter
     */
    public function __construct(
        TemplateGetterInterface $templateGetter
    ) {
        $this->templateGetter = $templateGetter;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $templates = $this->templateGetter->getList();

        $res = [];
        foreach ($templates as $templateId => $template) {
//            if (strpos($templateId, self::TEMPLATE_PREFIX) !== 0) {
                $res[] = [
                    'value' => $templateId,
                    'label' => $template['label'],
                ];
//            }
        }

        return $res;
    }
}
