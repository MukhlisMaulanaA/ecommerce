<?php

namespace Modules\Shop\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\Repositories\Front\Interface\CartRepositoryInterface;

class CartController extends Controller
{
  protected $cartRepository;
  
  public function __construct(CartRepositoryInterface $cartRepository)
  {
    $this->cartRepository = $cartRepository;
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
