<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

// @codingStandardsIgnoreFile
$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

/**
 * @var \MSP\NotifierApi\Api\Data\ChannelInterfaceFactory $channelFactory
 */
$channelFactory = $objectManager->get(\MSP\NotifierApi\Api\Data\ChannelInterfaceFactory::class);

/**
 * @var \MSP\NotifierApi\Api\ChannelRepositoryInterface $channelFactory
 */
$channelRepository = $objectManager->get(\MSP\NotifierApi\Api\ChannelRepositoryInterface::class);

/**
 * @var \MSP\NotifierEventApi\Api\Data\RuleInterfaceFactory $ruleFactory
 */
$ruleFactory = $objectManager->get(\MSP\NotifierEventApi\Api\Data\RuleInterfaceFactory::class);

/**
 * @var \MSP\NotifierEventApi\Api\RuleRepositoryInterface $ruleRepository
 */
$ruleRepository = $objectManager->get(\MSP\NotifierEventApi\Api\RuleRepositoryInterface::class);

/**
 * @var \MSP\Notifier\Model\SerializerInterface $serializer
 */
$serializer = $objectManager->get(\MSP\Notifier\Model\SerializerInterface::class);

// Create channel
$channel = $channelFactory->create();
$channel->setData([
    \MSP\NotifierApi\Api\Data\ChannelInterface::ENABLED => true,
    \MSP\NotifierApi\Api\Data\ChannelInterface::NAME => 'Test',
    \MSP\NotifierApi\Api\Data\ChannelInterface::CODE => 'test',
    \MSP\NotifierApi\Api\Data\ChannelInterface::ADAPTER_CODE => 'telegram',
    \MSP\NotifierApi\Api\Data\ChannelInterface::CONFIGURATION_JSON => $serializer->serialize([]),
]);

$channelId = $channelRepository->save($channel);

// Create test rules
$testRules = [
    [true, ['test_event_1', 'test_event_2']],
    [true, ['test_event_3']],
    [true, ['test_event_1']],
    [true, ['test_event_2']],
    [false, ['test_event_4']],
];

foreach ($testRules as $testRule) {
    $rule = $ruleFactory->create();
    $rule->setData([
        \MSP\NotifierEventApi\Api\Data\RuleInterface::ENABLED => $testRule[0],
        \MSP\NotifierEventApi\Api\Data\RuleInterface::CHANNELS_CODES => $serializer->serialize(['test']),
        \MSP\NotifierEventApi\Api\Data\RuleInterface::NAME => 'Test rule',
        \MSP\NotifierEventApi\Api\Data\RuleInterface::TEMPLATE_ID => 'default',
        \MSP\NotifierEventApi\Api\Data\RuleInterface::THROTTLE_INTERVAL => 3600,
        \MSP\NotifierEventApi\Api\Data\RuleInterface::THROTTLE_LIMIT => 60,
        \MSP\NotifierEventApi\Api\Data\RuleInterface::FIRE_COUNT => 0,
        \MSP\NotifierEventApi\Api\Data\RuleInterface::LAST_FIRED_AT => 0,
        \MSP\NotifierEventApi\Api\Data\RuleInterface::EVENTS => $serializer->serialize($testRule[1]),
    ]);
    $ruleRepository->save($rule);
}
