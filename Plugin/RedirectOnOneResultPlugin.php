<?php

namespace JanPetr\OneResultRedirect\Plugin;

use Algolia\AlgoliaSearch\Adapter\Algolia;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Api\Search\Document;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Search\Response\QueryResponse;

class RedirectOnOneResultPlugin
{
    /** @var Http */
    private $response;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * @param Http $response
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(Http $response, ProductRepositoryInterface $productRepository)
    {
        $this->response = $response;
        $this->productRepository = $productRepository;
    }

    /**
     * @param Algolia $subject
     * @param QueryResponse $result
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterQuery(Algolia $subject, $result)
    {
        if ($result->count() !== 1) {
            return $result;
        }

        /** @var Document $document */
        $document = $result->getIterator()->current();

        /** @var Product $product */
        $product = $this->productRepository->getById($document->getId());

        $url = $product->getProductUrl(false);
        $this->response->setRedirect($url)->sendResponse();

        return $result;
    }
}
