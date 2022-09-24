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
use Magento\Framework\App\ResponseInterface;
use Tigren\CustomerGroupCatalog\Model\RuleFactory;


/**
 * Class Save
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class Save extends Action
{
    /**
     * @var RuleFactory
     */
    private RuleFactory $_ruleFactory;

    /**
     * @param Context $context
     * @param RuleFactory $ruleFactory
     */
    public function __construct(Context $context, RuleFactory $ruleFactory)
    {
        parent::__construct($context);
        $this->_ruleFactory = $ruleFactory;
    }

    /**
     * @return ResponseInterface
     */
    public function execute()
    {
        if (!empty($data = $this->getRequest()->getPostValue())) {
            try {
                if (!empty($data['rule_id'])) {

                    $model = $this->_ruleFactory->create()->load($data['rule_id']);
                //                Edit Rule
                } else {
                    $model = $this->_ruleFactory->create();
                    //                Create Rule
                }
                $newData = [
                    'name' => $data['name'],
                    'customer_group_ids' => implode(
                        ',',
                        $data['customer_group_ids']
                    ),
                    'store_id' => implode(
                        ',',
                        $data['store_ids']
                    ),
                    'products' => $data['products'],
                    'discount_amount' => $data['discount_amount'],
                    'from_date' => $data['from_date'],
                    'to_date' => $data['to_date'],
                    'priority' => $data['priority'],
                    'is_active' => $data['is_active'],
                ];
                try {
                    $model->setData($newData);
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
