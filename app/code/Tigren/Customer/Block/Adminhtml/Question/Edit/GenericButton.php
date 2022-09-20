<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Block\Adminhtml\Question\Edit;

use Tigren\Customer\Controller\RegistryConstants;
use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton as CustomerQuestionGenericButton;

class GenericButton extends CustomerQuestionGenericButton
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\AuthorizationInterface $authorization
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
