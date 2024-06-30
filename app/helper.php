<?php

function profile($user) {
  if ($user->photo == null) {
    return 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png';
  }
  return url('storage/'.$user->photo);
}
function ongkir($user) {
  $info = \App\Models\ShopInfo::first();

  // Ensure the address_latlng fields are not empty
  if (!$info || !$user->address_latlng || !$info->address_latlng) {
      return 0; // Return 0 or handle the error appropriately
  }

  // Extract lat/lng for the shop
  list($infoLat, $infoLng) = explode(',', $info->address_latlng);

  // Extract lat/lng for the user
  list($userLat, $userLng) = explode(',', $user->address_latlng);

  // Convert from degrees to radians
  $latFrom = deg2rad($infoLat);
  $lonFrom = deg2rad($infoLng);
  $latTo = deg2rad($userLat);
  $lonTo = deg2rad($userLng);

  // Haversine formula
  $earthRadius = 6371; // Earth's radius in kilometers
  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $a = sin($latDelta / 2) * sin($latDelta / 2) +
       cos($latFrom) * cos($latTo) *
       sin($lonDelta / 2) * sin($lonDelta / 2);
  $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

  $distance = $earthRadius * $c;

  $ongkirResult = round($distance * $info->ongkir);
  return $ongkirResult; // This is the distance in kilometers
}
function defaultCashback($total) {
  $cb = config('services.cashback.amount');
  if (config('services.cashback.type') == 'percent') {
    $cb = round(($total*config('services.cashback.amount'))/100);
  }

  // Additional cashback for multiples of 50,000
  if (config('services.cashback.rule_type') == 'kelipatan') {
    $increment = 50000;
    if ($total > $increment) {
      $multiples = floor($total / $increment); // Calculate how many 50,000 multiples are there
      $cb = $multiples * $cb; // Multiply the base cashback by the number of multiples
    }
  }
  return $cb;
}
