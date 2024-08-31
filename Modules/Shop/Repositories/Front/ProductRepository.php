<?php

namespace Modules\Shop\Repositories\Front;

use Modules\Shop\App\Models\Product;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

  public function findAll($options = [])
  {
    $perPage = $options['per_page'] ?? null;

    $product = Product::with(['categories', 'tags']);

    if ($perPage) {
      return $product->paginate(($perPage));
    }

    return $product->get();
  }
}

