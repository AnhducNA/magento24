<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\DataObject;

class Display extends Action
{
    public function execute()
    {
//        echo 'Hello World';
//        exit;
        $textDisplay
            = new DataObject(['text' => 'Mageplaza']);
        $this->_eventManager->dispatch(
            'mageplaza_helloworld_display_text',
            ['mp_text' => $textDisplay]
        );
        echo $textDisplay->getText();
        exit;
    }
}
