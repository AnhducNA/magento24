<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\RestApi\Model\Api;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Tigren\RestApi\Api\Data\CategoryProductLinkInterface;
use Tigren\RestApi\Api\Data\CategoryProductLinkInterfaceFactory;

/**
 * Class CategoryLinkManagement
 */
class CategoryLinkManagement implements \Tigren\RestApi\Api\CategoryLinkManagementInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var CategoryProductLinkInterfaceFactory
     */
    protected $productLinkFactory;

    /**
     * CategoryLinkManagement constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryProductLinkInterfaceFactory $productLinkFactory
     */
    public function __construct(
        CategoryRepositoryInterface             $categoryRepository,
        CategoryProductLinkInterfaceFactory $productLinkFactory
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productLinkFactory = $productLinkFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssignedProducts(int $categoryId): array
    {
        $category = $this->categoryRepository->get($categoryId);
        if (!$category->getIsActive()) {
            return [[
                'error' => true,
                'error_desc' => 'Category is disabled'
            ]];
        }
        $categoryDesc = $category->getDescription();

        /** @var Collection $products */
        $products = $category->getProductCollection()
            ->addFieldToSelect('position')
            ->addFieldToSelect('name')
            ->addFieldToSelect('price');

        /** @var CategoryProductLinkInterface[] $links */
        $links = [];

        /** @var Product $product */
        foreach ($products->getItems() as $product) {
            $link = $this->productLinkFactory->create();
            $link->setSku($product->getSku())
                ->setName($product->getName())
                ->setPrice($product->getFinalPrice())
                ->setPosition($product->getData('cat_index_position'))
                ->setCategoryDescription($categoryDesc);
            $links[] = $link;
        }
        return $links;
    }
}
