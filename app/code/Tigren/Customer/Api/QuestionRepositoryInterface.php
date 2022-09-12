<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Tigren\Customer\Api\Data\QuestionInterface;

/**
 *
 */
interface QuestionRepositoryInterface
{

    /**
     * @param Data\QuestionInterface $customer
     * @param $passwordHash
     * @return mixed
     */
    public function save(Data\QuestionInterface $customer, $passwordHash = null);

    /**
     * @param $email
     * @param $websiteId
     * @return mixed
     */
    public function get($email, $websiteId = null);

    /**
     * @param $questionId
     * @return mixed
     */
    public function getById($questionId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param QuestionInterface $question
     * @return mixed
     */
    public function delete(QuestionInterface $question);

    /**
     * @param $questionId
     * @return mixed
     */
    public function deleteById($questionId);
}
