<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

class Rule extends AbstractExtensibleModel implements
    \MSP\NotifierEventApi\Api\Data\RuleInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(\MSP\NotifierEvent\Model\ResourceModel\Rule::class);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }

    /**
     * @inheritdoc
     */
    public function getEvents()
    {
        return $this->getData(self::EVENTS);
    }

    /**
     * @inheritdoc
     */
    public function setEvents($value)
    {
        return $this->setData(self::EVENTS, $value);
    }

    /**
     * @inheritdoc
     */
    public function getChannelsCodes()
    {
        return $this->getData(self::CHANNELS_CODES);
    }

    /**
     * @inheritdoc
     */
    public function setChannelsCodes($value)
    {
        return $this->setData(self::CHANNELS_CODES, $value);
    }

    /**
     * @inheritdoc
     */
    public function getTemplateId()
    {
        return $this->getData(self::TEMPLATE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setTemplateId($value)
    {
        return $this->setData(self::TEMPLATE_ID, $value);
    }

    /**
     * @inheritdoc
     */
    public function getThrottleLimit()
    {
        return $this->getData(self::THROTTLE_LIMIT);
    }

    /**
     * @inheritdoc
     */
    public function setThrottleLimit($value)
    {
        return $this->setData(self::THROTTLE_LIMIT, $value);
    }

    /**
     * @inheritdoc
     */
    public function getThrottleInterval()
    {
        return $this->getData(self::THROTTLE_INTERVAL);
    }

    /**
     * @inheritdoc
     */
    public function setThrottleInterval($value)
    {
        return $this->setData(self::THROTTLE_INTERVAL, $value);
    }

    /**
     * @inheritdoc
     */
    public function getLastFiredAt()
    {
        return $this->getData(self::LAST_FIRED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setLastFiredAt($value)
    {
        return $this->setData(self::LAST_FIRED_AT, $value);
    }

    /**
     * @inheritdoc
     */
    public function getFireCount()
    {
        return $this->getData(self::FIRE_COUNT);
    }

    /**
     * @inheritdoc
     */
    public function setFireCount($value)
    {
        return $this->setData(self::FIRE_COUNT, $value);
    }

    /**
     * @inheritdoc
     */
    public function getEnabled()
    {
        return $this->getData(self::ENABLED);
    }

    /**
     * @inheritdoc
     */
    public function setEnabled($value)
    {
        return $this->setData(self::ENABLED, $value);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        \MSP\NotifierEventApi\Api\Data\RuleExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
