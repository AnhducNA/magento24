<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Setup\Exception;
use Tigren\CustomerGroupCatalog\Model\RuleFactory;

/**
 * Class MassDelete
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class MassDelete extends Action
{
    /**
     * @var PageFactory
     */
    protected $PageFactory;
    /**
     * @var RuleFactory
     */
    protected $RuleFactory;

    /**
     * @param  Context  $context
     * @param  PageFactory  $pageFactory
     * @param  RuleFactory  $ruleFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        RuleFactory $ruleFactory,
    ) {
        parent::__construct($context);
        $this->PageFactory = $pageFactory;
        $this->RuleFactory = $ruleFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        if (!empty($this->getRequest()->getParams())) {
            foreach ($this->getRequest()->getParams()['selected'] as $idRule) {
                echo $idRule;
                if (!empty($idRule)) {
                    $collection = $this->RuleFactory->create()->load($idRule);
                    try {
                        $collection->delete();
                        $this->messageManager->addSuccessMessage(__('Delete rule success'));
                    } catch (Exception $e) {
                        $this->messageManager->addErrorMessage(__('Fail to save data'
                            .$e->getMessage()));
                    }
                }
            }
        }

        return $this->_redirect('tigren_customergroupcatalog/rule');
    }
}
