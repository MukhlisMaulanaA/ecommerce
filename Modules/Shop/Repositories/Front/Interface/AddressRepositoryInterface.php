<?php

namespace Modules\Shop\Repositories\Front\Interface;

use App\Models\User;

interface AddressRepositoryInterface
{
  public function findByUser(User $user);
  
}