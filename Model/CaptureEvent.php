<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

class CaptureEvent implements CaptureEventInterface
{
    /**
     * @var GetRulesIdsByEventInterface
     */
    private $getRulesIdsByEvent;

    /**
     * @var FireRuleInterface
     */
    private $fireRule;

    /**
     * @var EventExcludeInterface
     */
    private $eventExclude;

    /**
     * CaptureEvent constructor.
     * @param GetRulesIdsByEventInterface $getRulesIdsByEvent
     * @param FireRuleInterface $fireRule
     * @param EventExcludeInterface $eventExclude
     */
    public function __construct(
        GetRulesIdsByEventInterface $getRulesIdsByEvent,
        FireRuleInterface $fireRule,
        EventExcludeInterface $eventExclude
    ) {
        $this->getRulesIdsByEvent = $getRulesIdsByEvent;
        $this->fireRule = $fireRule;
        $this->eventExclude = $eventExclude;
    }

    /**
     * @inheritdoc
     */
    public function execute(string $eventName, array $data = []): bool
    {
        if ($this->eventExclude->execute($eventName, $data)) {
            return false;
        }

        $ruleIds = $this->getRulesIdsByEvent->execute($eventName);
        foreach ($ruleIds as $ruleId) {
            $this->fireRule->execute((int) $ruleId, $eventName, $data);
        }

        return true;
    }
}
