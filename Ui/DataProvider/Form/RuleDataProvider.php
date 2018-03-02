<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\NotifierEvent\Ui\DataProvider\Form;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use MSP\Notifier\Model\SerializerInterface;
use MSP\NotifierEvent\Model\AutomaticTemplateIdInterface;
use MSP\NotifierEventApi\Api\RuleRepositoryInterface;

class RuleDataProvider extends DataProvider
{
    /**
     * @var RuleRepositoryInterface
     */
    private $ruleRepository;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * RuleDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param RuleRepositoryInterface $ruleRepository
     * @param SerializerInterface $serializer
     * @param UrlInterface $url
     * @param array $meta
     * @param array $data
     * @SuppressWarnings(PHPMD.LongVariable)
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        RuleRepositoryInterface $ruleRepository,
        SerializerInterface $serializer,
        UrlInterface $url,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );

        $this->ruleRepository = $ruleRepository;
        $this->url = $url;
        $this->serializer = $serializer;
    }

    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        $data = parent::getData();

        // Unpack configuration
        foreach ($data['items'] as &$item) {
            $item['channels_codes'] = $this->serializer->unserialize($item['channels_codes']);
            $item['events'] = strtolower(implode("\n", $this->serializer->unserialize($item['events'])));
            $item['template_id_auto'] =
                ($item['template_id'] === AutomaticTemplateIdInterface::AUTOMATIC_TEMPLATE_ID) ? '1' : '0';
        }

        return $data;
    }
}
