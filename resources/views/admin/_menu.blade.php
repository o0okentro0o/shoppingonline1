<div class="border-bottom">
  <div class="float-left">
    <ul class="menu">
      <li class="menu"><a href="home">Home</a></li>
      <li class="menu"><a href="listcategory">Category</a></li>
      <li class="menu"><a href="listproduct">Product</a></li>
      <li class="menu"><a href="listorder">Order</a></li>
      <li class="menu"><a href="listcustomer">Customer</a></li>
    </ul>
  </div>
  <div class="float-right">
    Hello <b>{{ Session::get('admin')->Username }}</b> | <a href="logout">Logout</a>
  </div>
  <div class="float-clear"></div>
</div>