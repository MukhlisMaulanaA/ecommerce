<?php

namespace Modules\Shop\Repositories\Front\Interface;

use App\Models\User;

interface CartRepositoryInterface
{
  public function findByUser(User $user);
}