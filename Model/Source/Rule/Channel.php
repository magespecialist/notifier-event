<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Source\Rule;

use Magento\Framework\Option\ArrayInterface;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;

class Channel implements ArrayInterface
{
    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    public function __construct(
        ChannelRepositoryInterface $channelRepository
    ) {
        $this->channelRepository = $channelRepository;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $res = [];
        $channels = $this->channelRepository->getList()->getItems();

        foreach ($channels as $channel) {
            $res[] = [
                'value' => $channel->getCode(),
                'label' => $channel->getName(),
            ];
        }

        return $res;
    }
}
