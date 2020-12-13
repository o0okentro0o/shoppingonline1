<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ProductDAO
{
  static function selectAll()
  {
    $prods = DB::table('Product')
    ->leftJoin('Category', 'Product.CatID', '=', 'Category.ID')
    ->select('Product.*', 'Category.Name as Category_name')
    ->get();
    return $prods;
  }
  static function insert($prod)
  {
    $affected = DB::table('Product')->insert(['Name' => $prod->Name, 'Price' => $prod->Price, 'Image' => $prod->Image, 'CDate' => $prod->CDate, 'CatID' => $prod->CatID]);
    if ($affected > 0) return true;
    return false;
  }
  static function selectByID($id)
  {
    $prod = DB::table('Product')
    ->leftJoin('Category', 'Product.CatID', '=', 'Category.ID')
    ->select('Product.*', 'Category.Name as Category_name')
    ->get()
    ->where('ID', $id)->first();
    return $prod;
  }
  static function update($prod)
  {
    $affected = DB::table('Product')->where('ID', $prod->ID)->update(['Name' => $prod->Name, 'Price' => $prod->Price, 'Image' => $prod->Image, 'CDate' => $prod->CDate, 'CatID' => $prod->CatID]);
    if ($affected > 0) return true;
    return false;
  }
  static function delete($id)
  {
    $affected = DB::table('Product')->where('ID', $id)->delete();
    if ($affected > 0) return true;
    return false;
  }
  static function selectTopNew($top) {
    $prods = DB::table('Product')->orderBy('CDate', 'DESC')->limit($top)->get();
    return $prods;
  }
  static function selectTopHot($top) {
    $prods = DB::table('Product')->leftJoin('OrderDetail', 'Product.ID', '=', 'OrderDetail.ProdID')->leftJoin('COrder', 'OrderDetail.OrderID', '=', 'COrder.ID')->where('COrder.Status', 'APPROVED')
      ->selectRaw('Product.*, SUM(OrderDetail.Quantity) AS SumOfQuantity')
      ->groupBy('OrderDetail.ProdID')
      ->orderBy('SumOfQuantity', 'DESC')
      ->limit($top)->get();
    return $prods;
  }
  static function selectByCateID($cateid) {
    $prods = DB::table('Product')->where('CatID', $cateid)->get();
    return $prods;
  }
  static function selectByKeyword($keyword) {
    $prods = DB::table('Product')->where('Name', 'like', '%' . $keyword . '%')->get();
    return $prods;
  }
}
