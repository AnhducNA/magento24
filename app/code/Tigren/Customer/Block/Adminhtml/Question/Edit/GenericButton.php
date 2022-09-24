<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Block\Adminhtml\Question\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton as CustomerQuestionGenericButton;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Registry;
use Tigren\Customer\Controller\RegistryConstants;

/**
 * Class GenericButton
 * @package Tigren\Customer\Block\Adminhtml\Question\Edit
 */
class GenericButton extends CustomerQuestionGenericButton
{
    /**
     * @var AuthorizationInterface
     */
    protected $authorization;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AuthorizationInterface $authorization
     */
    public function __construct(
        Context     $context,
        Registry               $registry,
        AuthorizationInterface $authorization
    ) {
        $this->authorization = $context->getAuthorization() ?: $authorization;
        parent::__construct($context, $registry);
    }

    /**
     * Return the current Catalog Rule Id.
     *
     * @return int|null
     */
    public function getQuestionId()
    {
        $customerQuestino = $this->registry->registry(RegistryConstants::CURRENT_CUSTOMER_QUESTION_ID);
        return $customerQuestino ? $customerQuestino->getId() : null;
    }
}
