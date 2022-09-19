<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\RestApi\Api;

use Tigren\RestApi\Api\Data\CategoryProductLinkInterface;

/**
 * @api
 */
interface CategoryLinkManagementInterface
{
    /**
     * Get products assigned to a category
     *
     * @param int $categoryId
     * @return CategoryProductLinkInterface[]
     */
    public function getAssignedProducts(int $categoryId): array;
}
