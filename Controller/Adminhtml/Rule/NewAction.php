<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Controller\Adminhtml\Rule;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * NewAction Controller
 */
class NewAction extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MSP_NotifierEvent::rule';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('MSP_NotifierEvent::rule');
        $resultPage->getConfig()->getTitle()->prepend(__('New Rule'));

        return $resultPage;
    }
}
