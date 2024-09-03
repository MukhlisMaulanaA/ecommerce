<?php

namespace Modules\Shop\Repositories\Front\Interface;

use App\Models\User;
use Modules\Shop\App\Models\Cart;
use Modules\Shop\App\Models\Product;
use Modules\Shop\App\Models\CartItem;

interface CartRepositoryInterface
{
  public function findByUser(User $user): Cart;

  public function addItem(Product $product, $qty): CartItem;

  public function removeItem($id): bool;

  public function updateQty($items = []): void;

  public function clear(User $user): void;
}