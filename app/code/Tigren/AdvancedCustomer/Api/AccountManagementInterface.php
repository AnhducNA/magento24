<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCustomer\Api;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\LocalizedException;

interface AccountManagementInterface
{
    /**
     * Create customer account. Perform necessary business operations like sending email.
     *
     * @param CustomerInterface $customer
     * @param string $password
     * @param string $redirectUrl
     * @return CustomerInterface
     * @throws LocalizedException
     */
    public function createAccount(
        CustomerInterface $customer,
        $password = null,
        $redirectUrl = ''
    );
}
