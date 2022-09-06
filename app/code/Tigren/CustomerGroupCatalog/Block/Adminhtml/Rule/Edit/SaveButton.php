<?php

namespace Tigren\CustomerGroupCatalog\Block\Adminhtml\Rule\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getButtonData()
    {

        $data = [
            'label'    => __('Save'),
            'class'    => 'save primary',
            'on_click' => '',
        ];


        return $data;
    }
}
