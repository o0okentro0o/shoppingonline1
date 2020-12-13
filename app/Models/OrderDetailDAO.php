<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

class OrderDetailDAO {
  static function insert($odetail) {
    $affected = DB::table('OrderDetail')->
    insert(['OrderID' => $odetail->OrderID, 'ProdID' => $odetail->ProdID, 'Quantity' => $odetail->Quantity]);
    if ($affected > 0) return true;
    return false;
  }
  static function selectByOrderID($orderid) {
    $odetails = DB::table('OrderDetail')
    ->leftJoin('Product', 'OrderDetail.ProdID', '=', 'Product.ID')
    ->select('OrderDetail.*', 'Product.Name as Product_name')
    ->where('OrderID', $orderid)->get();
    return $odetails;
  }
}
?>