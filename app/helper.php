<?php

function profile($user) {
  if ($user->photo == null) {
    return 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png';
  }
  return $user->photo;
}
