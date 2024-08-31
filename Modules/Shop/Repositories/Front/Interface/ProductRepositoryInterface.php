<?php

namespace Modules\Shop\Repositories\Front\Interface;

interface ProductRepositoryInterface
{
  public function findAll($options = []);

  public function findBySKU($sku);
}