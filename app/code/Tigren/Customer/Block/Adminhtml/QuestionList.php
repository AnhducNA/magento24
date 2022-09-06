<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class QuestionList extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_question';
        $this->_blockGroup = 'Tigren_Customer';
        $this->_headerText = __('Questions');
        $this->_addButtonLabel = __('Create New Question');
        parent::_construct();
    }
}
