<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedQuestion\Model\Api;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Tigren\AdvancedQuestion\Api\QuestionInterface;
use Tigren\Customer\Model\QuestionFactory;
use Tigren\Customer\Model\ResourceModel\Question\CollectionFactory;

/**
 * Class Question
 * @package Tigren\AdvancedQuestion\Model\Api
 */
class Question implements QuestionInterface
{
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @var DateTime
     */
    protected $_date;

    /**
     * @var Session
     */
    protected $_customerSession;
    /**
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $collectionFactory
     * @param DateTime $date
     */

    public function __construct(
        QuestionFactory   $questionFactory,
        CollectionFactory $collectionFactory,
        DateTime          $date,
        Session         $customerSession,
    ) {
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->_date = $date;
        $this->_customerSession = $customerSession;

    }

    /**
     * POST for test api
     * @param int $id
     * @param string $title
     * @param string $content
     * @return string
     * @throws Exception
     */
    public function saveQuestion(int $id, string $title, string $content)
    {
        $idCustomerLogin = $this->_customerSession->getId() ? $this->_customerSession->getId() : null;
        $date = $this->_date->gmtDate();
        $newData = [
            'title' => $title,
            'content' => $content,
            'created_at' => $date,
            'author_id'=>$idCustomerLogin];

        if ($id != 0) {
            $model = $this->questionFactory->create()->load($id);
            $model->setTitle($title);
            $model->setContent($content);
            $model->save();
            return 'successfully update';
        } else {
            $model = $this->questionFactory->create();
            $model->setData($newData);
            $model->save();
            return 'successfully create';
        }
    }

    /**
     * @param int $id
     * @return string
     */
    public function deleteQuestion(int $id)
    {
        $model = $this->questionFactory->create()->load($id);
        $model->delete();

        return 'successfully delete';
    }
}
