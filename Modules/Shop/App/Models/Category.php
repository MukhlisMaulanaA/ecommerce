<?php

namespace Modules\Shop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\factories\CategoryFactory;

use App\Traits\UuidTrait;


class Category extends Model
{
  use HasFactory, UuidTrait;

  protected $table = 'shop_categories';
  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'parent_id',
    'slug',
    'name',
  ];

  protected static function newFactory(): CategoryFactory
  {
    return CategoryFactory::new();
  }

  public function children()
  {
    return $this->hasMany('Modules\Shop\App\Models\Category', 'parent_id');
  }

  public function parent()
  {
    return $this->belongsTo('Modules\Shop\App\Models\Category', 'parent_id');
  }

  public function products()
  {
    return $this->belongsToMany('Modules\Shop\App\Models\Product', 'shop_categories_products', 'product_id', 'category_id');
  }
}
