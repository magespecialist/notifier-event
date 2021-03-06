<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Ui\Component\Listing\Rule;

use Magento\Ui\Component\Listing\Columns\Column;
use MSP\NotifierEventApi\Api\Data\RuleInterface;

class Actions extends Column
{
    /**
     * @inheritdoc
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                $id = $item[RuleInterface::ID];

                $item[$name]['edit'] = [
                    'href' => $this->getContext()->getUrl('msp_notifier_event/rule/edit', [
                        RuleInterface::ID => $id
                    ]),
                    'label' => __('Edit')
                ];

                $item[$name]['delete'] = [
                    'href' => $this->getContext()->getUrl('msp_notifier_event/rule/delete', [
                        RuleInterface::ID => $id
                    ]),
                    'label' => __('Delete')
                ];
            }
        }

        return $dataSource;
    }
}
