<?php

namespace Tigren\AdvancedCheckout\Override\Block\CatalogWidget\Product;

class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
    protected function _construct()
    {
        $this->setTemplate('Tigren_AdvancedCheckout::product/widget/content/grid.phtml');
    }
}
