<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class AdminDAO
{
  static function selectByUsername($username)
  {
    $admin = DB::table('Admin')->where('Username', $username)->first();
    return $admin;
  }
}
