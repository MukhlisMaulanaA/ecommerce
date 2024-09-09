<?php

namespace Modules\Shop\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class DashboardController extends Controller
{
  protected $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productsCnt = $this->productRepository->countTotalProduct();
    return $this->loadTheme('dashboards.index', ['products' => $productsCnt]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('shop::create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    //
  }

  /**
   * Show the specified resource.
   */
  public function show($id)
  {
    return view('shop::show');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    return view('shop::edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id): RedirectResponse
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    //
  }
}
