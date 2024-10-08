<?php

namespace Modules\Shop\Repositories\Front\Interface;

interface ProductRepositoryInterface
{
  public function findAll($options = []);

  public function findBySKU($sku);

  public function findByID($id);

  public function countTotalProduct(): int;

  public function storeProduct(array $data);
}