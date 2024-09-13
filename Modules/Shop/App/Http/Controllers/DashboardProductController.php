<?php

namespace Modules\Shop\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Modules\Shop\App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductStoreRequest;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;
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
      ->select(['id', 'name', 'sku', 'price', 'status', 'stock_status', 'sale_price', 'publish_date', 'featured_image'])->get();
    // dd($products);
    return $this->loadTheme('dashboards.products.index', ['products' => $products]);
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
    // dd($request->status);
    $validate = $request->validated();

    if (!$request->has('has_discount')) {
      $validate['sale_price'] = null; // Jika tidak ada diskon, set sale_price ke null
    }

    // Tentukan status produk (ACTIVE atau DRAFT)
    if ($request->status === 'ACTIVE') {
      $validate['status'] = 'ACTIVE';
      $validate['publish_date'] = Carbon::now(); // Set waktu sekarang sebagai publish_date
    } else {
      $validate['status'] = 'DRAFT';
      $validate['publish_date'] = null; // Produk dalam status draft tidak memiliki publish_date
    }

    // Simpan produk
    $store = $this->productRepository->storeProduct($validate);

    return $store
      ? Redirect::route('dashboards_products.create')->with('success', 'Berhasil menambahkan Produk!')
      : abort(500);
  }

  public function publish($id)
  {
    $product = Product::findOrFail($id);

    // Periksa apakah status produk DRAFT sebelum dipublish
    if ($product->status == 'DRAFT') {
      $product->status = 'ACTIVE';
      $product->publish_date = Carbon::now(); // Set waktu publish saat ini
      $product->save();

      // Set flash message sukses
      return redirect()->route('dashboards_products.index')->with('success', 'Produk berhasil dipublish!');
    }

    // Jika status bukan DRAFT, tampilkan pesan error
    return redirect()->route('dashboards_products.index')->with('error', 'Produk tidak dapat dipublish.');
  }
}
