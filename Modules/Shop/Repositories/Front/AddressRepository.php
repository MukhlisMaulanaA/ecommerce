<?php

namespace Modules\Shop\Repositories\Front;

use App\Models\User;
use Modules\Shop\App\Models\Address;
use Modules\Shop\Repositories\Front\Interface\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface {

  public function findByUser(User $user)
  {
    return Address::where('user_id', $user->id)->get();
    
  }

  public function findByID($id)
  {
    return Address::findOrFail($id);
  }
}

