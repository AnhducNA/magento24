<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Override\Block\CatalogWidget\Product;

/**
 * Class ProductsList
 * @package Tigren\AdvancedCheckout\Override\Block\CatalogWidget\Product
 */
class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->setTemplate('Tigren_AdvancedCheckout::product/widget/content/grid.phtml');
    }
}
