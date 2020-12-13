<html>
<head>
<title>Order</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="admin">
  @include('admin/_menu')
  <?php if (isset($orders)) { ?>
    <div class="align-center">
      <h2 class="text-center">ORDER LIST</h2>
      <table class="datatable" border="1">
        <tr class="datatable">
          <th>OrderID</th>
          <th>Name </th>
          <th>Creation date</th>
          <th>Total</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php foreach ($orders as $item) { ?>
          <tr class="datatable" onclick="window.location='listorder?id=<?= $item->ID ?>'">
            <th><?= $item->ID ?></th>
            <td><?= $item->Customer_name ?></td>
            <td><?= date("d/m/Y - H:i:s", ($item->CDate / 1000)) ?></td>
            <td><?= $item->Total ?></td>
            <td><?= $item->Status ?></td>
            <td>
              <?php if ($item->Status == 'PENDING') { ?>
                <a href="updatestatus?status=APPROVED&id=<?= $item->ID ?>">APPROVE</a>
                ||
                <a href="updatestatus?status=CANCELED&id=<?= $item->ID ?>">CANCEL</a>
              <?php } ?>
            </td>
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
</body>
</html>