<?php

namespace Modules\Shop\App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\factories\ProductInventoryFactory;

class ProductInventory extends Model
{
  use HasFactory, UuidTrait;

  protected $table = 'shop_product_inventories';

  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'product_id',
    'qty',
    'low_stock_threshold',
  ];

  protected static function newFactory(): ProductInventoryFactory
  {
    return ProductInventoryFactory::new();
  }
}
