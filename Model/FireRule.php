<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use MSP\NotifierApi\Api\ChannelRepositoryInterface;
use MSP\Notifier\Model\SerializerInterface;
use MSP\NotifierEventApi\Api\RuleRepositoryInterface;
use MSP\NotifierTemplateApi\Api\SendMessageInterface;
use Psr\Log\LoggerInterface;

class FireRule implements FireRuleInterface
{
    /**
     * @var RuleRepositoryInterface
     */
    private $ruleRepository;

    /**
     * @var ChannelRepositoryInterface
     */
    private $channelRepository;

    /**
     * @var SendMessageInterface
     */
    private $sendMessage;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ThrottleInterface
     */
    private $throttle;

    /**
     * @var AutomaticTemplateIdInterface
     */
    private $automaticTemplateId;

    /**
     * FireRule constructor.
     * @param RuleRepositoryInterface $ruleRepository
     * @param ChannelRepositoryInterface $channelRepository
     * @param SendMessageInterface $sendMessage
     * @param SerializerInterface $serializer
     * @param ThrottleInterface $throttle
     * @param AutomaticTemplateIdInterface $automaticTemplateId
     * @param LoggerInterface $logger
     * @SuppressWarnings(PHPMD.LongVariables)
     */
    public function __construct(
        RuleRepositoryInterface $ruleRepository,
        ChannelRepositoryInterface $channelRepository,
        SendMessageInterface $sendMessage,
        SerializerInterface $serializer,
        ThrottleInterface $throttle,
        AutomaticTemplateIdInterface $automaticTemplateId,
        LoggerInterface $logger
    ) {
        $this->ruleRepository = $ruleRepository;
        $this->channelRepository = $channelRepository;
        $this->sendMessage = $sendMessage;
        $this->serializer = $serializer;
        $this->logger = $logger;
        $this->throttle = $throttle;
        $this->automaticTemplateId = $automaticTemplateId;
    }

    /**
     * @inheritdoc
     */
    public function execute(int $ruleId, string $eventName, array $data)
    {
        try {
            $rule = $this->ruleRepository->get($ruleId);
        } catch (NoSuchEntityException $e) {
            return;
        }

        if (!$this->throttle->execute($rule)) {
            return;
        }

        $channelsCodes = $this->serializer->unserialize($rule->getChannelsCodes());

        foreach ($channelsCodes as $channelCode) {
            try {
                $data['_rule'] = $rule->getName();

                if ($rule->getTemplateId() === AutomaticTemplateIdInterface::AUTOMATIC_TEMPLATE_ID) {
                    $templateId = $this->automaticTemplateId->execute($rule, $eventName, $data);
                } else {
                    $templateId = $rule->getTemplateId();
                }

                $this->sendMessage->execute($channelCode, $templateId, $data);
            } catch (\Exception $e) {
                $this->logger->error(sprintf(
                    'Could not send message on channel %s: %s',
                    $channelCode,
                    $e->getMessage()
                ));
            }
        }
    }
}
