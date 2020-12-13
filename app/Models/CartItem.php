<?php
namespace App\Models;

class CartItem {
  public $product;
  public $quantity;
  function __construct($product, $quantity) {
    $this->product = $product;
    $this->quantity = $quantity;
  }
}
?>