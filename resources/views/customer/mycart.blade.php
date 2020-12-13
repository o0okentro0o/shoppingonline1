<html>
<head>
<title>My Cart</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="customer">
  @include('customer/_menu')
  @include('customer/_inform')
  <div class="align-center">
    <h2 class="text-center">ITEM LIST</h2>
    <table class="datatable" border="1">
      <tr class="datatable">
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Action</th>
      </tr>
      @foreach(Session::get('mycart')->items as $item)
      <tr class="datatable">
        <th><?= $item->product->ID ?></th>
        <td><?= $item->product->Name ?></td>
        <td><?= $item->product->Category_name ?></td>
        <td><img src="data:image/jpg;base64,<?= $item->product->Image ?>" width="70" height="70" /></td>
        <td><?= $item->product->Price ?></td>
        <td><?= $item->quantity ?></td>
        <td><?= $item->product->Price * $item->quantity ?></td>
        <td><a href="remove2cart?id=<?= $item->product->ID ?>">Remove</a></td>
      </tr>
      @endforeach
      <tr>
        <td colspan="5"></td>
        <td>Total</td>
        <td>{{ Session::get('mycart')->getTotal() }}</td>
        <td><a href="checkout" onclick="return confirm('ARE YOU SURE?')">CHECKOUT</a></td>
      </tr>
    </table>
  </div>
  <!--Start of Tawk.to Script
Nhân viên sale vào trang để trả lời khách hàng https://dashboard.tawk.to/#/chat-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fcefffea1d54c18d8f16cd9/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>