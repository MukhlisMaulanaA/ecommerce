<?php

namespace Modules\Shop\Repositories\Front;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\App\Models\Cart;
use Modules\Shop\App\Models\CartItem;
use Modules\Shop\App\Models\Product;
use Modules\Shop\Repositories\Front\Interface\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface {

  public function findByUser(User $user): Cart
  {
    $cart = Cart::with([
      'items',
      'items.product',
    ])->forUser($user)->first();

    if (!$cart) {
      return Cart::create([
        'user_id' => $user->id,
        'expired_at' => (new Carbon())->addDay(7),
        'tax_percent' => (env('TAX_PERCENT', 11) / 100)
      ]);
    }

    $this->calculateCart($cart);

    return $cart;
  }

  public function addItem(Product $product, $qty): CartItem
  {
    $cart = $this->findByUser(Auth::user());

    $existItem = CartItem::where([
      'cart_id' => $cart->id,
      'product_id' => $product->id,
    ])->first();

    if (!$existItem) {
      return CartItem::create([
        'cart_id' => $cart->id,
        'product_id' => $product->id,
        'qty' => $qty,
      ]);
    }

    if (($existItem->qty + $qty) > $product->stock) {
      return new CartItem();
    }

    $existItem->qty = $existItem->qty + $qty;
    $existItem->save();

    return $existItem;
  }

  public function removeItem($id): bool
  {
    return CartItem::where('id', $id)->delete();
  }

  public function clear(User $user): void
  {
    Cart::forUser($user)->delete();
  }

  public function updateQty($items = []): void
  {
    if (!empty($items)) {
      foreach ($items as $itemID => $qty) {
        $item = CartItem::where('id', $itemID)->first();
        if ($item) {
          $item->qty = $qty;
          $item->save();
        }
      }
    }
  }

  private function calculateCart(Cart $cart): void
  {
    $baseTotalPrice = 0;
    $taxAmount = 0;
    $discountAmount = 0;
    $discountPercent= 0;
    $grandTotal = 0;
    $totalWeight = 0;

    if (count($cart->items) > 0) {
      foreach ($cart->items as $item) {
        $baseTotalPrice += $item->qty * $item->product->price;

        if ($item->product->has_sale_price) {
          $discountAmountItem = $item->product->price - $item->product->sale_price;
          $discountAmount += $item->qty * $discountAmountItem;
        }

        $totalWeight += ($item->qty * $item->product->weight);
      }
    }

    $netTotal = $baseTotalPrice - $discountAmount;
    $taxAmount = 0.11 * $netTotal;
    $grandTotal = $netTotal + $taxAmount;
    
    if ($baseTotalPrice) {
      $discountPercent = ($discountAmount / $baseTotalPrice) * 100;
  }

    $cart->update([
      'base_total_price' => $baseTotalPrice,
      'tax_amount' => $taxAmount,
      'discount_amount' => $discountAmount,
      'discount_percent' => $discountPercent,
      'grand_total' => $grandTotal,
      'total_weight' => $totalWeight,
    ]);


  }
}

