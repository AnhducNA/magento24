<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Model;
use Tigren\Customer\Api\QuestionManagementInterface;
use Tigren\Customer\Model\QuestionFactory;
use Tigren\Customer\Model\ResourceModel\Question\CollectionFactory;
class QuestionManagement implements QuestionManagementInterface
{
    private $QuestionFactory;
    private $CollectionFactory;
    public function __construct(QuestionFactory $QuestionFactory,CollectionFactory $CollectionFactory)
    {
        $this->QuestionFactory = $QuestionFactory;
        $this->CollectionFactory = $CollectionFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        $name =$data['name'];
        $number =$data['number'];
        $city =$data['city'];
        $insertData = $this->QuestionFactory->create();
        $insertData->setName($name)->save();
        $insertData->setNumber($number)->save();
        $insertData->setCity($city)->save();
        return 'successfully saved';
}
}
