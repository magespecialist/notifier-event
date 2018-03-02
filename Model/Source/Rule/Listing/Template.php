<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Source\Rule\Listing;

use Magento\Framework\Option\ArrayInterface;
use MSP\NotifierEvent\Model\AutomaticTemplateIdInterface;

class Template implements ArrayInterface
{
    /**
     * @var \MSP\NotifierEvent\Model\Source\Rule\Template
     */
    private $template;

    /**
     * Template constructor.
     * @param \MSP\NotifierEvent\Model\Source\Rule\Template $template
     */
    public function __construct(
        \MSP\NotifierEvent\Model\Source\Rule\Template $template
    ) {
        $this->template = $template;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $res = $this->template->toOptionArray();
        array_unshift($res, [
            'value' => AutomaticTemplateIdInterface::AUTOMATIC_TEMPLATE_ID,
            'label' => '' . __('Automatic template selection'),
        ]);

        return $res;
    }
}
