<?php

namespace Modules\Shop\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Modules\Shop\Repositories\Front\Interface\CartRepositoryInterface;
use Modules\Shop\Repositories\Front\Interface\ProductRepositoryInterface;
use Modules\Shop\App\Models\Product;

class CartController extends Controller
{
  protected $cartRepository;

  protected $productRepository;
  
  public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface $productRepository)
  {
    $this->cartRepository = $cartRepository;
    $this->productRepository = $productRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $cart = $this->cartRepository->findByUser(auth()->user());
    $this->data['cart'] = $cart;
    return $this->loadTheme('carts.index', $this->data);
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
  public function store(Request $request)// : RedirectResponse
  {
    $productID = $request->get('product_id');
    $qty = $request->get('qty');

    $product = $this->productRepository->findByID($productID);

    if ($product->stock_status != Product::STATUS_IN_STOCK) {
      return redirect(shop_product_link($product))->with('error', 'Tidak ada stok produk.');
    }
    
    if ($product->stock < $qty) {
      return redirect(shop_product_link($product))->with('error', 'Stock produk tidak mencukupi.');
    }

    $item = $this->cartRepository->addItem($product, $qty);
    if (!$item) {
      return redirect(shop_product_link($product))->with('error', 'Tidak dapat menambahkan Item ke Keranjang.');
    }

    return redirect(shop_product_link($product))->with('success', 'Berhasil menambahkan Item ke Keranjang.');
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
  public function update(Request $request)
  {
    $items = $request->get('qty');
    $this->cartRepository->updateQty($items);

    return redirect(route('carts.index'))->with('success', 'Keranjang telah diperbarui.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $this->cartRepository->removeItem($id);

    return redirect(route('carts.index'))->with('success', 'Berhasil menghapus Item dari Keranjang.');
  }
}
