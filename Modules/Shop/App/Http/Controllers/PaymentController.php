<?php

namespace Modules\Shop\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Shop\App\Models\Order;
use PHPUnit\Event\TestSuite\Loaded;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\App\Models\Payment;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
  public function midtrans(Request $request)
  {
    $payload = $request->getContent();
    $notification = json_decode($payload);
    
    if ((bool)env('MIDTRANS_PRODUCTION', false)) {
      $validSignatureKey = hash('sha512', $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));
      if ($notification->signature_key != $validSignatureKey) {
        return response(['code' => 403, 'message' => 'Invalid signature key'], 403);
      }
    }

    $this->initPaymentGateway();

    $paymentNotification = new \Midtrans\Notification();
    $order = Order::where('id', $paymentNotification->order_id)->first();

    if (!$order) {
      return response(['code' => 404, 'message' => 'Order not Found'], 404);
    }

    $transaction = $paymentNotification->transaction_status;
    $type = $paymentNotification->payment_type;
    $order_id = $paymentNotification->order_id;
    $fraud = $paymentNotification->fraud_status;
    $paymentSuccess = false;

    error_log($payload);
    error_log("Order ID $paymentNotification->order_id: " . "transaction status = $transaction, fraud status = $fraud");

    if ($transaction == 'capture') {
      if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
          $paymentSuccess = false;
        } else {
          $paymentSuccess = true;
        }
      }
    } else if ($transaction == 'settlement') {
      $paymentSuccess = true;
    } else if (in_array($transaction, ['pending', 'deny', 'expire', 'cancel'])) {
      $paymentSuccess = false;
    }

    $paymentParams = [
      'code' => Payment::generateCode(),
      'user_id' => $order->user_id,
      'order_id' => $order->id,
      'status' => $transaction,
      'payment_gateway' => 'MIDTRANS',
      'payment_type' => $paymentNotification->payment_type,
      'amount' => $paymentNotification->gross_amount,
      'payloads' => $payload,
    ];

    $payment = Payment::create($paymentParams);

    if ($paymentSuccess && $payment) {
      DB::beginTransaction();
      try {
        $order->status = Order::STATUS_CONFIRMED;
        $order->save();

      } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
      }
      DB::commit();

      // Redirect ke halaman sukses setelah transaksi berhasil
      return redirect()->route('payments.success')->with('success', 'Transaksi berhasil. Terimakasi atas pembelian Anda.');
    }

    $message = 'Payment status is : ' . $transaction;

    // Mengembalikan response standar untuk status selain sukses
    return response(['code' => 200, 'message' => $message], 200);
  }

  private function initPaymentGateway()
  {
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
    \Midtrans\Config::$isProduction = (bool)env('MIDTRANS_PRODUCTION', false);
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
  }

  public function paymentSuccess(Request $request)
  {
    $payload = $request->getContent();
    $notification = json_decode($payload);

    $statusPayment = $notification->transaction_status;
    $priceAmount = $notification->gross_amount;
    $orderID = $notification->order_id;
    $statusTransaction = '';

    if ($statusPayment == 'settlement') {
      $statusTransaction = 'Berhasil';
    } else {
      $statusTransaction = 'Pending';
    }

    $dataPayment = [
      'status_payment' => $statusTransaction,
      'amount' => number_format($priceAmount),
      'order_id' => $orderID,
    ];

    return $this->loadTheme('orders.success_payment', ['dataPayment' => $dataPayment]);
  }
}
