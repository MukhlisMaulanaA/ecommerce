<?php

namespace Modules\Shop\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Shop\Repositories\Front\Interface\OrderRepositoryInterface;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class DashboardIndexController extends Controller
{
  protected $productRepository;

  protected $orderRepository;

  public function __construct(ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository)
  {
    $this->productRepository = $productRepository;
    $this->orderRepository = $orderRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productsCnt = $this->productRepository->countTotalProduct();
    $totalRevenue = $this->orderRepository->getTotalRevenue();
    $totalOrder = $this->orderRepository->getTotalOrder();
    return $this->loadTheme('dashboards.index', ['products' => $productsCnt, 'revenue' => $totalRevenue, 'order' => $totalOrder]);
  }

  
}
