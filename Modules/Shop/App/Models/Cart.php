<?php

namespace Modules\Shop\App\Models;

use App\Models\User;
use App\Traits\UuidTrait;
use Modules\Shop\App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Database\factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Query\Builder;

class Cart extends Model
{
  use HasFactory, UuidTrait;

  protected $table = 'shop_carts';
  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'user_id',
    'expired_at',
    'base_total_price',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function items()
  {
    return $this->hasMany(CartItem::class);
  }

  public function scopeForUser(Builder $query, User $user): void
  {
    $query->where('user_id', $user->id);
  }

}
