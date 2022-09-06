<?php

namespace Tigren\AdvancedCheckout\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Customdropdown extends AbstractSource
{
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
