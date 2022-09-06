<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Controller\Adminhtml\Question;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Tigren\Customer\Controller\Adminhtml\Question;

class Grid extends Question
{
    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}
