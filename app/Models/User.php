<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
      'name',
      'email',
      'phone',
      'photo',
      'role',
      'password',
      'address',
      'address_latlng',
      'last_cashback_at'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
      'password',
      'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */

   public function vouchers() {
    return $this->belongsToMany('App\Models\Voucher', 'user_vouchers', 'user_id', 'voucher_id')->withTimestamps()->withPivot('used_at');
   }
   public function activeVouchers() {
    return $this->belongsToMany('App\Models\Voucher', 'user_vouchers', 'user_id', 'voucher_id')->withTimestamps()->withPivot('used_at')->where(function($query) {
      $query->where('user_vouchers.used_at', null)->where(function($query) {
        $query->whereDate('expired_at', '>', now())->orWhereNull('expired_at');
      });
    });
   }
   public function usedVouchers() {
    return $this->belongsToMany('App\Models\Voucher', 'user_vouchers', 'user_id', 'voucher_id')->withTimestamps()->withPivot('used_at')->where(function($query) {
      $query->where('user_vouchers.used_at', '<>', null)->orWhere(function($query) {
        $query->whereDate('expired_at', '>', now())->orWhereNull('expired_at');
      });
    });
   }
   public function carts() {
    return $this->hasMany('App\Models\Cart', 'user_id');
   }
   public function transactions() {
    return $this->hasMany('App\Models\Transaction', 'user_id');
   }
   public function coins() {
    return $this->hasMany('App\Models\UserCoin', 'user_id');
   }
   public function activeCoins() {
    return $this->hasMany('App\Models\UserCoin', 'user_id')->whereStatus('settlement');
   }
   public function pendingCoins() {
    return $this->hasMany('App\Models\UserCoin', 'user_id')->whereStatus('pending');
   }

  //  ===================================================
   public function canClaimCashback() {
    return (!auth()->user()->last_cashback_at && auth()->user()->transactions()->whereStatus('settlement')->count() >= 3) || (auth()->user()->last_cashback_at && auth()->user()->transactions()->whereStatus('settlement')->whereDate('created_at', '>', auth()->user()->last_cashback_at)->count() >= 3);
   }
}
