<?php

namespace Modules\Shop\Repositories\Front;

use Modules\Shop\App\Models\Tag;
use Modules\Shop\App\Models\Product;
use Modules\Shop\App\Models\Category;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

  public function findAll($options = [])
  {
    // Cek options
    $perPage = $options['per_page'] ?? null;
    $categorySlug = $options['filter']['category'] ?? null;
    $tagSlug = $options['filter']['tag'] ?? null;
    $priceFilter = $options['filter']['price'] ?? null;
    $sort = $options['sort'] ?? null;
    $status = $options['status'] ?? null;

    $products = Product::with(['categories', 'tags']);

    // Filter produk berdasarkan kategori
    if ($categorySlug) {
      $category = Category::where('slug', $categorySlug)->firstOrFail();

      $childCategoryIDs = Category::childIDs($category->id);

      $categoryIDs = array_merge([$category->id], $childCategoryIDs);

      $products = $products->whereHas('categories', function ($query) use ($categoryIDs) {
        $query->whereIn('shop_categories.id', $categoryIDs);
      });
    }

    // Filter produk berdasarkan tag
    if ($tagSlug) {
      $tag = Tag::where('slug', $tagSlug)->firstOrFail();

      $products = $products->whereHas('tags', function ($query) use ($tag) {
        $query->where('shop_tags.id', $tag->id);
      });
    }

    
    if ($priceFilter) {
      $products = $products->where('price', '>=', $priceFilter['min'])
      ->where('price', '<=', $priceFilter['max']);
    }

    if ($sort) {
      $products = $products->orderBy($sort['sort'], $sort['order']);
    }

    if ($status) {
      $products = $products->where('status', '=', 'ACTIVE');
    }
    
    if ($perPage) {
      return $products->paginate(($perPage));
    }

    return $products->get();
  }

  public function findBySKU($sku)
  {
    return Product::where('sku', $sku)->firstOrFail();
  }

  public function findByID($id)
  {
    return Product::where('id', $id)->firstOrFail();
  }

  public function countTotalProduct(): int
  {
    return Product::count();
  }

  public function storeProduct(array $data)
  {
    // Jika ada gambar, simpan ke storage
    if (isset($data['featured_image'])) {
      $imagePath = $data['featured_image']->store('products', 'public');
      $data['featured_image'] = $imagePath;
  }

  // Simpan data produk ke database
  return Product::create($data);
  }

}

