<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\RestApi\Api\Data;

/**
 * @api
 */
interface CategoryProductLinkInterface
{
    /**
     * @return string|null
     */
    public function getSku();

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): static;

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * @return float|null
     */
    public function getPrice();

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): static;

    /**
     * @return int|null
     */
    public function getPosition();

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition(int $position): static;

    /**
     * @return string|null
     */
    public function getCategoryDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setCategoryDescription($description);
}
