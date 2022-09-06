<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;

class Example extends Action
{

    protected $title;

    public function execute()
    {
//        echo('Welcome');
        echo $this->Title('Welcome');
//        echo $this->getTitle();
    }

    public function Title($title)
    {
        return $this->title = $title;
    }

}
