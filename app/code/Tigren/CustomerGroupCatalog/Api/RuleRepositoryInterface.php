<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tigren\CustomerGroupCatalog\Api\Data\RuleInterface;

/**
 * @api
 */
interface RuleRepositoryInterface
{
    /**
     * @param  RuleInterface  $rule
     *
     * @return RuleInterface
     * @throws CouldNotSaveException
     */
    public function save(
        RuleInterface $rule
    );

    /**
     * @param  int  $ruleId
     *
     * @return RuleInterface
     * @throws NoSuchEntityException
     */
    public function get($ruleId);

    /**
     * @param  RuleInterface  $rule
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(
        RuleInterface $rule
    );

    /**
     * @param  int  $ruleId
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById($ruleId);
}
