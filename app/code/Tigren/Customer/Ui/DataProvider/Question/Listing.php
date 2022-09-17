<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\Customer\Ui\DataProvider\Question;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Tigren\Customer\Model\ResourceModel\Question\CollectionFactory;

class Listing extends AbstractDataProvider
{
    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if ($filter->getField() == 'entity_id') {
            $filter->setField('main_table.' . $filter->getField());
        }
        parent::addFilter($filter);
    }
}