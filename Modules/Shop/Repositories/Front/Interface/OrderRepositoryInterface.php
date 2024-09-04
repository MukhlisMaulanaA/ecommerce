<?php

namespace Modules\Shop\Repositories\Front\Interface;

use App\Models\User;
use Modules\Shop\App\Models\Cart;
use Modules\Shop\App\Models\Order;
use Modules\Shop\App\Models\Address;

interface OrderRepositoryInterface {
  public function create(User $user, Cart $cart, Address $address, $shipping = []): Order;

  public function findByOrderId(string $orderId);

  public function getOrdersByUserId($userId);

}