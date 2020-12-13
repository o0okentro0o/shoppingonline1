<html>
<head>
  <title>Order</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="customer">
  @include('customer/_menu')
  @include('customer/_inform')
  <?php if (isset($orders)) { ?>
    <div class="align-center">
      <h2 class="text-center">ORDER LIST</h2>
      <table class="datatable" border="1">
        <tr class="datatable">
          <th>OrderID</th>
          <th>CustomerName</th>
          <th>Creation date</th>
          <th>Total</th>
          <th>Status</th>
        </tr>
        <?php foreach ($orders as $item) { ?>
          <tr class="datatable" onclick="window.location='myorders?id=<?= $item->ID ?>'">
            <th><?= $item->ID ?></th>
            <td><?= $item->Customer_name ?></td>
            <td><?= date("d/m/Y - H:i:s", ($item->CDate / 1000)) ?></td>
            <td><?= $item->Total ?></td>
            <td><?= $item->Status ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  <?php } ?>
  <?php if (isset($odetails)) { ?>
    <div class="align-center">
      <h2 class="text-center">ORDER DETAIL</h2>
      <table class="datatable" border="1">
        <tr class="datatable">
          <th>OrderID</th>
          <th>NameProduct</th>
          <th>Quantity</th>
        </tr>
        <?php foreach ($odetails as $item) { ?>
          <tr class="datatable">
            <td><?= $item->OrderID ?></td>
            <td><?= $item->Product_name ?></td>
            <td><?= $item->Quantity ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  <?php } ?>
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