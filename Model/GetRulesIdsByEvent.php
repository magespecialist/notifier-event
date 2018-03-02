<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

/**
 * @inheritdoc
 */
class GetRulesIdsByEvent implements GetRulesIdsByEventInterface
{
    /**
     * @var GetRulesIdsByEventRegistry
     */
    private $getRulesIdsByEventRegistry;

    /**
     * GetRulesIdsByEvent constructor.
     * @param GetRulesIdsByEventRegistry $getRulesIdsByEventRegistry
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function __construct(
        GetRulesIdsByEventRegistry $getRulesIdsByEventRegistry
    ) {
        $this->getRulesIdsByEventRegistry = $getRulesIdsByEventRegistry;
    }

    /**
     * @param string $eventName
     * @return array
     */
    public function execute(string $eventName): array
    {
        return $this->getRulesIdsByEventRegistry->get($eventName);
    }
}
