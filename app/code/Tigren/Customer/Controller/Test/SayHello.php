<?php
namespace Tigren\Customer\Controller\Test;

use Magento\Framework\App\Action\Action;

class SayHello extends Action
{

    public function execute()
    {
        echo 'Hello World! Welcome to Tigren.com';
        exit;
    }
}

?>
