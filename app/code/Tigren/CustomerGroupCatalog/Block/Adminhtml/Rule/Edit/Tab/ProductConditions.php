<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Block\Adminhtml\Rule\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Form\Renderer\Fieldset;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\Form;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Rule\Block\Conditions;
use Magento\Rule\Model\Condition\AbstractCondition;
use Tigren\CustomerGroupCatalog\Controller\RegistryConstants;
use Tigren\CustomerGroupCatalog\Model\Rule;

/**
 *
 */
class ProductConditions extends Generic implements TabInterface
{
    /**
     * @var Fieldset
     */
    protected $rendererFieldset;

    /**
     * @var Conditions
     */
    protected $conditions;

    /**
     * @var string
     */
    protected $_nameInLayout = 'actions_apply_to';

    /**
     * @param  Context  $context
     * @param  Registry  $registry
     * @param  FormFactory  $formFactory
     * @param  Fieldset  $rendererFieldset
     * @param  Conditions  $conditions
     * @param  array  $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Fieldset $rendererFieldset,
        Conditions $conditions,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->rendererFieldset = $rendererFieldset;
        $this->conditions = $conditions;
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Product Conditions');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Product Conditions');
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $formName = 'tigren_customergroupcatalog_rule_form';
        /** @var Rule $model */
        $model
            = $this->_coreRegistry->registry(RegistryConstants::CURRENT_GROUPCATALOG_RULE_ID);
        /** @var Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        /* start condition block*/
        $fieldset = $form->addFieldset(
            'conditions_fieldset',
            ['legend' => __('Conditions')]
        );
        $renderer = $this->rendererFieldset
            ->setTemplate('Tigren/CustomerGroupCatalog::rule/condition/fieldset.phtml')
            ->setFieldSetId($model->getConditionsFieldSetId($formName))
            ->setNewChildUrl(
                $this->getUrl(
                    'tigren_customergroupcatalog/rule/newConditionHtml/form/'
                    .$model->getConditionsFieldSetId($formName),
                    ['form_namespace' => $formName]
                )
            );

        $fieldset->setRenderer($renderer);

        $fieldset->addField(
            'conditions',
            'text',
            [
                'name'           => 'conditions',
                'label'          => __('Product Conditions'),
                'title'          => __('Product Conditions'),
                'required'       => true,
                'data-form-part' => $formName,
            ]
        )
            ->setRule($model)
            ->setRenderer($this->conditions);

        $form->setValues($model->getData());
        $this->setConditionFormName(
            $model->getConditions(),
            $formName,
            $model->getConditionsFieldSetId($formName)
        );
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @param  AbstractCondition  $conditions
     * @param  string  $formName
     *
     * @return void
     */
    private function setConditionFormName(
        AbstractCondition $conditions,
        $formName,
        $fieldsetName
    ) {
        $conditions->setFormName($formName);
        $conditions->setJsFormObject($fieldsetName);
        if ($conditions->getConditions()
            && is_array($conditions->getConditions())
        ) {
            foreach ($conditions->getConditions() as $condition) {
                $this->setConditionFormName(
                    $condition,
                    $formName,
                    $fieldsetName
                );
            }
        }
    }
}
