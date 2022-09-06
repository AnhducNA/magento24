<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Tigren\CustomerGroupCatalog\Model\RuleFactory;

/**
 * Class Delete
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class Delete extends Action
{
    /**
     * @var RuleFactory
     */
    private $_ruleFactory;

    /**
     * @param  Context  $context
     * @param  RuleFactory  $ruleFactory
     */
    public function __construct(Context $context, RuleFactory $ruleFactory)
    {
        parent::__construct($context);
        $this->_ruleFactory = $ruleFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!empty($idRule = $this->getRequest()->getParams())) {
            try {
                $model = $this->_ruleFactory->create()->load($idRule);
                print_r($idRule);
//                die();
                try {
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__('Delete rule success'));
                } catch (Exception $e) {
                    $this->messageManager->addErrorMessage(__('Fail to save data'
                        .$e->getMessage()));
                }
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the rule data. Please review the error log.'
                        .$e->getMessage())
                );
            }
        }

        return $this->_redirect('tigren_customergroupcatalog/rule');
    }
}
