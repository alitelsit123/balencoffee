<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
  use HasFactory;
  protected $fillable = [
    'transaction_id',
    'product_id',
    'quantity',
    'price'
  ];
  public function product() {
    return $this->belongsTo('\App\Models\Product', 'product_id');
  }
}
