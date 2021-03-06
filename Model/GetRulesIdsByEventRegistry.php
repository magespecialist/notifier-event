<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use MSP\Notifier\Model\SerializerInterface;
use MSP\NotifierEvent\Model\ResourceModel\Rule\CollectionFactory;
use MSP\NotifierEventApi\Api\Data\RuleInterface;

class GetRulesIdsByEventRegistry
{
    /**
     * @var array
     */
    private $rulesRegistryMap = null;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * GetRulesIdsByEventRegistry constructor.
     * @param CollectionFactory $collectionFactory
     * @param SerializerInterface $serializer
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        SerializerInterface $serializer
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->serializer = $serializer;
    }

    /**
     * Builds a rule registry map
     */
    private function buildRulesRegistryMap()
    {
        $this->rulesRegistryMap = [];

        $collection = $this->collectionFactory->create();
        $collection
            ->addFieldToFilter(RuleInterface::ENABLED, true);

        foreach ($collection as $rule) {
            if (!$rule->getEvents()) {
                continue;
            }

            /** @var RuleInterface $rule */
            $events = $this->serializer->unserialize($rule->getEvents());
            $events = array_unique(array_map('strtolower', $events));

            foreach ($events as $event) {
                if (!isset($this->rulesRegistryMap[$event])) {
                    $this->rulesRegistryMap[$event] = [];
                }

                $this->rulesRegistryMap[$event][] = $rule->getId();
            }
        }
    }

    /**
     * Clear internal registry
     */
    public function clearRegistry()
    {
        $this->rulesRegistryMap = null;
    }

    /**
     * @param string $eventName
     * @return array
     */
    public function get(string $eventName): array
    {
        if ($this->rulesRegistryMap === null) {
            $this->buildRulesRegistryMap();
        }

        if (isset($this->rulesRegistryMap[$eventName])) {
            return $this->rulesRegistryMap[$eventName];
        }

        return [];
    }
}
