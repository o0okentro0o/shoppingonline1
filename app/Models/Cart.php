<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

class Cart {
  public $items;
  function __construct() {
    $this->items = array();
  }
  function addItem($newItem) {
    foreach ($this->items as $item) {
      if ($item->product->ID == $newItem->product->ID) {
        $item->quantity += $newItem->quantity;
        return;
      }
    }
    array_push($this->items, $newItem);
  }
  function getSize() {
    return count($this->items);
  }
  function getTotal() {
    $total = 0;
    foreach ($this->items as $item) {
      $total += $item->product->Price * $item->quantity;
    }
    return $total;
  }
  function getItem($id) {
    $item = DB::table('Product')
    ->leftJoin('Category', 'Product.CatID', '=', 'Category.ID')
    ->select('Product.*', 'Category.Name as Category_name')
    ->get();
    foreach ($this->items as $item)
      if ($item->product->ID == $id)
        return $item;
    return null;
  }
  function removeItem($item) {
    if (($key = array_search($item, $this->items)) !== false)
      unset($this->items[$key]);
  }
}
?>