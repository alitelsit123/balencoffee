<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;
  protected $fillable = [
    'status',
    'token',
    'delivery_address',
    'delivery_pinpoint',
    'subtotal',
    'total',
    'user_id',
    'confirmed_at',
    'provider_id',
    'estimation',
    'estimation_type',
    'ongkir'
  ];
  public function user() {
    return $this->belongsTo('App\Models\User', 'user_id');
  }
  public function detailProducts() {
    return $this->hasMany('App\Models\TransactionProduct', 'transaction_id');
  }
  public function detailVouchers() {
    return $this->hasMany('App\Models\TransactionVoucher', 'transaction_id');
  }
  public function coins() {
    return $this->hasMany('App\Models\UserCoin', 'transaction_id');
  }
}
