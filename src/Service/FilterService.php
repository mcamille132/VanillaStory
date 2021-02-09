<?php

namespace App\Service;

use App\Model\ProductManager;

class FilterService
{
    public function getProductFromSearch(array $search)
    {
        $productManager = new ProductManager();
        if (!empty($search['category_id'])) {
            return $productManager->searchByCategory($search['category_id']);
        }
        if (!empty($search['size_id'])) {
            return $productManager->searchBySize($search['size_id']);
        }
    }
}
