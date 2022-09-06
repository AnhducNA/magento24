<?php

namespace Tigren\Customer\Controller\Test;

use Magento\Framework\App\Action\Action;

class Forward extends Action
{
    protected function _forward(
        $action,
        $controller = null,
        $module = null,
        array $params = null
    ) {
        $request = $this->getRequest();
        $request->initForward();
        if (isset($params)) {
            $request->setParams($params);
        }
        if (isset($controller)) {
            $request->setControllerName($controller);
            // Module should only be reset if controller has been specified
            if (isset($module)) {
                $request->setModuleName($module);
            }
        }
        $request->setActionName($action);
        $request->setDispatched(false);
    }

    public function execute()
    {
//        $this->_forward('sayhello');
        $this->_redirect('*/*/sayhello');

    }
}
