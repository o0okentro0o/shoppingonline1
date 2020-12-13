<html>

<head>
<title>Category</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
  <script>
    function details(id, name) {
      document.getElementById("txtID").value = id;
      document.getElementById("txtName").value = name;
      document.getElementById("btnUpdate").style.display = "inline";
      document.getElementById("btnDelete").style.display = "inline";
    }
  </script>
</head>

<body class="admin">
  @include('admin/_menu')
  <div class="float-left">
    <h2 class="text-center">CATEGORY LIST</h2>
    <table class="datatable" border="1">
      <tr class="datatable">
        <th>ID</th>
        <th>Name</th>
      </tr>
      <?php foreach ($cates as $item) { ?>
        <tr class="datatable" onclick="details('<?= $item->ID ?>','<?= $item->Name ?>')">
          <th><?= $item->ID ?></th>
          <td><?= $item->Name ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="inline" style="width: 40px"></div>
  <div class="float-right">
    <h2 class="text-center">CATEGORY DETAIL</h2>
    <form method="POST">
      @csrf
      <table>
        <tr>
          <td>ID</td>
          <td><input type="text" id="txtID" name="txtID" readonly /></td>
        </tr>
        <tr>
          <td>Name</td>
          <td><input type="text" id="txtName" name="txtName" required /></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" formaction="addcategory" value="ADD NEW" />
            <input type="submit" formaction="updatecategory" value="UPDATE" id="btnUpdate" style="display:none" />
            <input type="submit" formaction="deletecategory" value="DELETE" id="btnDelete" style="display:none" onclick="return confirm('ARE YOU SURE?')" />
          </td>
        </tr>
      </table>
    </form>
  </div>
  <div class="float-clear"></div>
</body>

</html>