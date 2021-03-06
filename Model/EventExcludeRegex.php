<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

class EventExcludeRegex implements EventExcludeInterface
{
    /**
     * @var array
     */
    private $skipEvents;

    /**
     * EventExclude constructor.
     * @param array $skipEvents
     */
    public function __construct(
        array $skipEvents = []
    ) {
        $this->skipEvents = $skipEvents;
    }

    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(string $eventName, array $data = []): bool
    {
        foreach ($this->skipEvents as $skipEvent) {
            if (preg_match($skipEvent, $eventName)) {
                return true;
            }
        }

        return false;
    }
}
