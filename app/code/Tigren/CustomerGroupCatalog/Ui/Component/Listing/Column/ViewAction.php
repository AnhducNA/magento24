<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class ViewAction extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param  ContextInterface  $context
     * @param  UiComponentFactory  $uiComponentFactory
     * @param  UrlInterface  $urlBuilder
     * @param  array  $components
     * @param  array  $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param  array  $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item[$this->getData('config/indexField')])) {
                    $urlEntityParamName
                        = $this->getData('config/urlEntityParamName') ?: 'id';
                    $config = (array)$this->getData('config');
                    if ($config && isset($config['buttons'])) {
                        foreach ($config['buttons'] as $actionName => $button) {
                            $label = $button['itemLabel'];
                            $item[$this->getData('name')][$actionName] = [
                                'href'  => $this->urlBuilder->getUrl(
                                    $button['urlPath'],
                                    [
                                        $urlEntityParamName => $item[$this->getData('config/indexField')],
                                    ]
                                ),
                                'label' => __($label),
                            ];
                        }
                    }
                }
            }
        }

        return $dataSource;
    }
}
