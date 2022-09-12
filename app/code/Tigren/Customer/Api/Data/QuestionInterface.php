<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Customer\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Customer entity interface for API handling.
 *
 * @api
 * @since 100.0.2
 */
interface QuestionInterface extends CustomAttributesDataInterface
{
    /**#@+
     * Constants defined for keys of the data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID = 'entity_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const AUTHOR_ID = 'author_id';

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getAuthorId();

    /**
     * @param $authorId
     * @return mixed
     */
    public function setAuthorId($authorId);

}
