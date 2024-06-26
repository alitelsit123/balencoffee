<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopInfo extends Model
{
  use HasFactory;
  protected $fillable = [
    "name",
    'phone',
    'address',
    'address_latlng',
    'description',
    'ongkir'
  ];
}
