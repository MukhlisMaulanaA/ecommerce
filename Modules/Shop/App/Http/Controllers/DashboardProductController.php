<?php

namespace Modules\Shop\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductStoreRequest;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;

class DashboardProductController extends Controller
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
    // return $this->loadTheme('dashboard.products.create');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return $this->loadTheme('dashboards.products.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductStoreRequest $request): RedirectResponse
  {
    // dd($request->all());
    $validate = $request->validated();
    
    if (!$request->has('has_discount')) {
      $validate['sale_price'] = null; // Jika tidak ada diskon, set sale_price ke null
    }
    // Simpan produk
    $store = $this->productRepository->storeProduct($validate);

    // Set flash message
    // session()->flash('success', 'Produk berhasil ditambahkan!');

    // Redirect ke halaman daftar produk
    // return redirect()->route('dashboards_products.create');

    return $store 
      ? Redirect::route('dashboards_products.create')->with('success', 'Berhasil menambahkan Produk!')
      : abort(500);
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
    
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    //
  }
}
