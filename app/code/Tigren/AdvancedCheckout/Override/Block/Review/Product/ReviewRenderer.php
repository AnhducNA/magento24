<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Override\Block\Review\Product;

class ReviewRenderer extends \Magento\Review\Block\Product\ReviewRenderer
{
    protected function _construct()
    {
        $this->setTemplate('Tigren_AdvancedCheckout::helper/summary.phtml');
    }

}
