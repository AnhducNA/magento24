<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Display
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Index
 */
class Display extends Action
{

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $str = '$59.00';
        $number = 10;
        $str = ltrim($str, $str[0]);
        $str = substr($str, 1);
        echo $str;
    }
}
