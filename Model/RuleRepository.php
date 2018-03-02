<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RuleRepository implements \MSP\NotifierEventApi\Api\RuleRepositoryInterface
{
    /**
     * @var \MSP\NotifierEvent\Model\Rule\Command\SaveInterface
     */
    private $commandSave;

    /**
     * @var \MSP\NotifierEvent\Model\Rule\Command\GetInterface
     */
    private $commandGet;

    /**
     * @var \MSP\NotifierEvent\Model\Rule\Command\DeleteInterface
     */
    private $commandDeleteById;

    /**
     * @var \MSP\NotifierEvent\Model\Rule\Command\GetListInterface
     */
    private $commandGetList;

    /**
     * @param \MSP\NotifierEvent\Model\Rule\Command\SaveInterface $commandSave
     * @param \MSP\NotifierEvent\Model\Rule\Command\GetInterface $commandGet
     * @param \MSP\NotifierEvent\Model\Rule\Command\DeleteInterface $commandDeleteById
     * @param \MSP\NotifierEvent\Model\Rule\Command\GetListInterface $commandGetList
     */
    public function __construct(
        \MSP\NotifierEvent\Model\Rule\Command\SaveInterface $commandSave,
        \MSP\NotifierEvent\Model\Rule\Command\GetInterface $commandGet,
        \MSP\NotifierEvent\Model\Rule\Command\DeleteInterface $commandDeleteById,
        \MSP\NotifierEvent\Model\Rule\Command\GetListInterface $commandGetList
    ) {
        $this->commandSave = $commandSave;
        $this->commandGet = $commandGet;
        $this->commandDeleteById = $commandDeleteById;
        $this->commandGetList = $commandGetList;
    }

    /**
     * @inheritdoc
     */
    public function save(\MSP\NotifierEventApi\Api\Data\RuleInterface $rule): int
    {
        return $this->commandSave->execute($rule);
    }

    /**
     * @inheritdoc
     */
    public function get(int $ruleId): \MSP\NotifierEventApi\Api\Data\RuleInterface
    {
        return $this->commandGet->execute($ruleId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $ruleId)
    {
        $this->commandDeleteById->execute($ruleId);
    }

    /**
     * @inheritdoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria = null
    ): \MSP\NotifierEventApi\Api\RuleSearchResultsInterface {
        return $this->commandGetList->execute($searchCriteria);
    }
}
