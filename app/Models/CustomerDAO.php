<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class CustomerDAO {
  static function selectByUsernameOrEmail($username, $email) {
    $cust = DB::table('Customer')->where('Username', $username)->orWhere('Email', $email)->first();
    return $cust;
  }
  static function insert($cust) {
    $id = DB::table('Customer')->insertGetId(['Username' => $cust->Username, 'Password' => $cust->Password, 'Name' => $cust->Name, 'Phone' => $cust->Phone, 'Email' => $cust->Email, 'Active' => $cust->Active, 'Token' => $cust->Token]);
    return $id;
  }
  static function active($id, $token, $active) {
    $affected = DB::table('Customer')->where([['ID', $id], ['Token', $token]])->update(['Active' => $active]);
    if ($affected > 0) return true;
    return false;
  }
  static function selectByUsernameAndPassword($username, $password) {
    $cust = DB::table('Customer')->where([['Username', $username], ['Password', $password]])->first();
    return $cust;
  }
  static function update($cust) {
    $affected = DB::table('Customer')->where('ID', $cust->ID)->update(['Username' => $cust->Username, 'Password' => $cust->Password, 'Name' => $cust->Name, 'Phone' => $cust->Phone, 'Email' => $cust->Email, 'Active' => $cust->Active, 'Token' => $cust->Token]);
    if ($affected > 0) return true;
    return false;
  }
  static function selectAll() {
    $custs = DB::table('Customer')->get();
    return $custs;
  }
  static function selectByID($id) {
    $cust = DB::table('Customer')->where('ID', $id)->first();
    return $cust;
  }
}
?>