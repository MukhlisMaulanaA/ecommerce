<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class HomeController extends Controller
{
  protected $productRepository;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(ProductRepositoryInterface $productRepository)
  {
    // $this->middleware('auth');
    $this->productRepository = $productRepository;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $options = [
      'per_page' => $this->perPage,
    ];

    $this->data['products'] = $this->productRepository->findAll($options);
    // dd($this->data['products']->toArray());

    return $this->loadTheme('home', $this->data);
  }
}
