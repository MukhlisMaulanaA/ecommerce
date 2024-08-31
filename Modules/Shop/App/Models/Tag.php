<?php

namespace Modules\Shop\App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\factories\TagFactory;

class Tag extends Model
{
  use HasFactory, UuidTrait;

  protected $table = 'shop_tags';

  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'slug',
    'name',
  ];

  protected static function newFactory(): TagFactory
  {
    return TagFactory::new();
  }

  public function products()
  {
    return $this->belongsToMany('Modules\Shop\App\Models\Product', 'shop_product_tags', 'tag_id', 'product_id');
  }
}
