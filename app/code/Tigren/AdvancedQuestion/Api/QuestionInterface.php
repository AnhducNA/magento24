<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedQuestion\Api;

interface QuestionInterface
{
    /**
     * POST for test api
     * @param int $id
     * @param string $title
     * @param string $content
     * @return string
     */
    public function saveQuestion(int $id, string $title, string $content);

    /**
     * @param int $id
     * @return string
     */
    public function deleteQuestion(int $id);

}
