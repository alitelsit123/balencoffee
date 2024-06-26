<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'code',
    'type',
    'stock',
    'expired_at',
    'amount',
    'amount_type'
  ];
}
