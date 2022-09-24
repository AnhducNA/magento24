<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Block\Adminhtml\Rule\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton as CatalogRuleGenericButton;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Registry;
use Tigren\CustomerGroupCatalog\Controller\RegistryConstants;

/**
 * Class GenericButton
 * @package Tigren\CustomerGroupCatalog\Block\Adminhtml\Rule\Edit
 */
class GenericButton extends CatalogRuleGenericButton
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
        Context $context,
        Registry           $registry,
        AuthorizationInterface                $authorization
    ) {
        $this->authorization = $context->getAuthorization() ?: $authorization;
        parent::__construct($context, $registry);
    }

    /**
     * Return the current Catalog Rule Id.
     *
     * @return int|null
     */
    public function getRuleId()
    {
        $groupcatRule
            = $this->registry->registry(RegistryConstants::CURRENT_GROUPCATALOG_RULE_ID);
        return $groupcatRule ? $groupcatRule->getId() : null;
    }
}
