<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Plugin\Event;

use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use MSP\NotifierEvent\Model\CaptureEventInterface;

class ManagerInterfacePlugin
{
    /**
     * @var bool
     */
    private $skipCapture = false;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * ManagerInterfacePlugin constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager // Must use object manager to avoid recursions in event manager plugin
    ) {
        $this->objectManager = $objectManager;
    }

    /**
     * @param ManagerInterface $subject
     * @param string $eventName
     * @param array $data
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeDispatch(
        ManagerInterface $subject,
        $eventName,
        array $data = []
    ) {
        if (!$this->skipCapture) {
            $this->skipCapture = true; // Deadlock protection
            try {
                // @codingStandardsIgnoreStart
                // Must use object manager to avoid recursions in event manager plugin
                $captureEvent = $this->objectManager->get(CaptureEventInterface::class);
                // @codingStandardsIgnoreEnd
                $captureEvent->execute($eventName, $data);
            } catch (\Exception $e) {

            }
            $this->skipCapture = false;
        }

        return [$eventName, $data];
    }
}
