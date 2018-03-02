<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model\Rule\Command;

use Magento\Framework\Exception\CouldNotSaveException;
use MSP\NotifierEvent\Model\ResourceModel\Rule;
use MSP\NotifierEvent\Model\Rule\Validator\RuleValidatorInterface;
use MSP\NotifierEventApi\Api\Data\RuleInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class Save implements SaveInterface
{
    /**
     * @var Rule
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var RuleValidatorInterface
     */
    private $ruleValidator;

    /**
     * @param Rule $resource
     * @param RuleValidatorInterface $ruleValidator
     * @param LoggerInterface $logger
     */
    public function __construct(
        Rule $resource,
        RuleValidatorInterface $ruleValidator,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
        $this->ruleValidator = $ruleValidator;
    }

    /**
     * @inheritdoc
     */
    public function execute(RuleInterface $rule): int
    {
        $this->ruleValidator->execute($rule);

        try {
            $this->resource->save($rule);
            return (int) $rule->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Rule'), $e);
        }
    }
}
