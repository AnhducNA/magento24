<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class Customdropdown
 * @package Tigren\AdvancedCheckout\Model\Config\Source
 */
class Customdropdown extends AbstractSource
{

    /**
     * @return array|array[]|null
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('--Select--'), 'value' => ''],
                ['label' => __('Option 1'), 'value' => 1],
                ['label' => __('Option 2'), 'value' => 2],
            ];
        }

        return $this->_options;
    }
}
