<html>
<head>
<title>Customer</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="admin">
  @include('admin/_menu')
  <?php if (isset($custs)) { ?>
    <div class="align-center">
      <h2 class="text-center">CUSTOMER LIST</h2>
      <table class="datatable" border="1">
        <tr class="datatable">
          <th>ID</th>
          <th>Username</th>
          <th>Password</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Active</th>
          <th>Action</th>
        </tr>
        <?php foreach ($custs as $item) { ?>
          <tr class="datatable" onclick="window.location='listcustomer?cid=<?= $item->ID ?>'">
            <th><?= $item->ID ?></th>
            <td><?= $item->Username ?></td>
            <td><?= $item->Password ?></td>
            <td><?= $item->Name ?></td>
            <td><?= $item->Phone ?></td>
            <td><?= $item->Email ?></td>
            <td><?= $item->Active ?></td>
            <td>
              <?php if ($item->Active == 0) { ?>
                <a href="sendmail?id=<?= $item->ID ?>">EMAIL</a>
              <?php } else if ($item->Active == 1) { ?>
                <a href="deactive?id=<?= $item->ID ?>&token=<?= $item->Token ?>" onclick="return confirm('ARE YOU SURE?')">DEACTIVE</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  <?php } ?>
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
          <tr class="datatable" onclick="window.location='listcustomer?cid=<?= $item->CustID ?>&oid=<?= $item->ID ?>'">
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
          <th>ProductName</th>
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