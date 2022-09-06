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
use Zend_Log;
use Zend_Log_Writer_Stream;

/**
 * Class Save
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class Save extends Action
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
     * @throws \Zend_Log_Exception
     */
    public function execute()
    {
        $writer = new Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new Zend_Log();
        $logger->addWriter($writer);
//        $logger->info(print_r('hihi', true));
        if (!empty($data = $this->getRequest()->getParams())) {
            try {
                if (!empty($data['id'])) {
                    $model = $this->_ruleFactory->create()->load($data['id']);
                //                Edit Rule
                } else {
                    $model = $this->_ruleFactory->create();
                    //                Create Rule
                }
                $newArray = [
                    'name'               => $data['name'],
                    'customer_group_ids' => implode(
                        ',',
                        $data['customer_group_ids']
                    ),
                    'store_id'           => implode(
                        ',',
                        $data['store_ids']
                    ),
                    'products'           => $data['products'],
                    'discount_amount'    => $data['discount_amount'],
                    'from_date'          => $data['from_date'],
                    'to_date'            => $data['to_date'],
                    'priority'           => $data['priority'],
                    'is_active'          => $data['is_active'],
                ];
                try {
                    $model->setData($newArray);
                    $model->save();
                    $this->messageManager->addSuccessMessage(__('Create rule success'));
                } catch (Exception $e) {
                    $this->messageManager->addErrorMessage(__('Fail to save data'
                        . $e->getMessage()));
                }
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the rule data. Please review the error log.'
                        . $e->getMessage())
                );
            }
        }

        return $this->_redirect('tigren_customergroupcatalog/rule/index');
    }
}
