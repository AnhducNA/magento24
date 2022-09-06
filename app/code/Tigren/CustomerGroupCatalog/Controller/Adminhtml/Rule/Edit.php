<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Amasty\Groupcat\Controller\RegistryConstants;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

/**
 * Class Edit
 *
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule
 */
class Edit extends Rule
{
//    /**
//     * @var PageFactory
//     */
//    protected $_pageFactory;
//
//    /**
//     * @param  Context  $context
//     * @param  PageFactory  $pageFactory
//     */
//    public function __construct(
//        Action\Context $context,
//        PageFactory $pageFactory
//    ) {
//        $this->_pageFactory = $pageFactory;
//        parent::__construct($context);
//    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->ruleRepository->get($id);
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('This rule no longer exists.'));

                return $this->resultRedirectFactory->create()
                    ->setPath('amasty_groupcat/*');
            }
        } else {
            /** @var \Magento\CatalogRule\Model\Rule $model */
            $model = $this->ruleFactory->create();
        }
        // set entered data if was error when we do save
        $data = $this->_session->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->coreRegistry->register(
            RegistryConstants::CURRENT_GROUPCAT_RULE_ID,
            $model
        );
        $resultPage = $this->_initAction();

        // set title and breadcrumbs
        $breadcrumb = $id ? __('Edit Customer Group Catalog Rule')
            : __('New Customer Group Catalog Rule');
        $resultPage->addBreadcrumb($breadcrumb, $breadcrumb);
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Manage Customer Group Catalog Rule'));
        $resultPage->getConfig()->getTitle()->prepend(
            $model->getRuleId() ? $model->getName()
                : __('New Customer Group Catalog Rule')
        );

        return $resultPage;

//        $resultPage = $this->_pageFactory->create();

//        $resultPage->getConfig()->getTitle()
//            ->prepend(__('Edit Customer Group Catalog Rule'));

//        die('aaa');

//        return $resultPage;
    }
}
