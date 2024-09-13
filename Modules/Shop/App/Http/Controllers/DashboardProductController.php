<?php

namespace Modules\Shop\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductStoreRequest;
use Modules\Shop\App\Models\Category;
use Modules\Shop\App\Models\Product;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
// use DataTables;

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
    $products = Product::with(['categories', 'inventory'])
    ->select(['name', 'sku', 'price', 'status', 'stock_status', 'sale_price', 'publish_date', 'featured_image'])->get();
    // dd($products);
    return $this->loadTheme('dashboards.products.index', [ 'products' => $products]);
  }

  // public function getData()
  // {
  //   $products = Product::with(['categories', 'inventory'])
  //   ->select(['id', 'name', 'sku', 'price', 'status', 'stock_status', 'sale_price', 'publish_date', 'featured_image']);

  //   return Datatables::of($products)
  //     ->addColumn('category', function($product) {
  //       return $product->category ? $product->category->name : 'Tidak ada';
  //     })
  //     ->addColumn('inventory', function($product) {
  //       return $product->inventory ? $product->inventory->qty : 'N/A';
  //     })
  //     ->addColumn('featured_image', function($product) {
  //         return '<img src="'. asset('storage/' . $product->featured_image) .'" width="50" height="50">';
  //     })
  //     // ->addColumn('action', function($product) {
  //     //     return '
  //     //         <a href="'. route('admin.products.edit', $product->id) .'" class="btn btn-sm btn-primary">Edit</a>
  //     //         <a href="'. route('admin.products.destroy', $product->id) .'" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus produk ini?\')">Hapus</a>
  //     //     ';
  //     // })
  //     ->filter(function ($query) {
  //         if (request()->has('category_id') && request('category_id') != '') {
  //             $query->where('category_id', request('category_id'));
  //         }
  //         if (request()->has('status') && request('status') != '') {
  //             $query->where('status', request ('status'));
  //         }
  //     })
  //     ->rawColumns(['featured_image'])  
  //     ->make(true);

  // }

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
  // public function update(Request $request, $id): RedirectResponse
  // {
    
  // }

  // /**
  //  * Remove the specified resource from storage.
  //  */
  // public function destroy($id)
  // {
  //   //
  // }
}
