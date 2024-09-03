<?php

namespace Modules\Shop\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\factories\PaymentFactory;

class Payment extends Model
{
  use HasFactory, HasUuids;

  protected $table = 'shop_payments';


  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'user_id',
    'order_id',
    'code',
    'payment_type',
    'status',
    'approved_by',
    'approved_at',
    'note',
    'rejected_by',
    'rejected_at',
    'rejection_note',
    'amount',
    'payloads',
];

public const EXPIRY_DURATION = 1;
public const EXPIRY_UNIT = 'days';
public const PAYMENT_CHANNELS = [
    'mandiri_clickpay',
    'cimb_clicks',
    'bca_klikbca',
    'bca_klikpay',
    'bri_epay',
    'echannel',
    'permata_va',
    'bca_va',
    'bni_va',
    'other_va',
    'gopay',
    'indomaret',
    'danamon_online',
];

public const PAYMENT_CODE = 'PAY';

  protected static function newFactory(): PaymentFactory
  {
    return PaymentFactory::new();
  }
}
