<html>

<head>
<title>Product</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
  <script>
    function previewImage(input) {
      var reader = new FileReader();
      reader.onload = function(evt) {
        document.getElementById("imgProduct").src = evt.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }

    function details(id, name, price, catID, image) {
      document.getElementById("txtID").value = id;
      document.getElementById("txtName").value = name;
      document.getElementById("txtPrice").value = price;
      document.getElementById("cmbCategory").value = catID;
      document.getElementById("imgProduct").src = "data:image/jpg;base64," + image;
      document.getElementById("btnUpdate").style.display = "inline";
      document.getElementById("btnDelete").style.display = "inline";
    }
  </script>
</head>

<body class="admin">
  @include('admin/_menu')
  <div class="float-left">
    <h2 class="text-center">PRODUCT LIST</h2>
    <table class="datatable" border="1">
      <tr class="datatable">
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Creation date</th>
        <th>Category</th>
        <th>Image</th>
      </tr>
      <?php foreach ($prods as $item) { ?>
        <tr class="datatable" onclick="details('<?= $item->ID ?>','<?= $item->Name ?>','<?= $item->Price ?>','<?= $item->CatID ?>','<?= $item->Image ?>')">
          <th><?= $item->ID ?></th>
          <td><?= $item->Name ?></td>
          <td><?= $item->Price ?></td>
          <td><?= date("d/m/Y - H:i:s", ($item->CDate / 1000)) ?></td>
          <td><?= $item->Category_name ?></td>
          <td><img src="data:image/jpg;base64,<?= $item->Image ?>" width="100" height="100" /></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="inline" style="width: 40px"></div>
  <div class="float-right">
    <h2 class="text-center">PRODUCT DETAIL</h2>
    <form method="POST" enctype="multipart/form-data">
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
          <td>Price</td>
          <td><input type="number" id="txtPrice" name="txtPrice" min="1" max="999" required /></td>
        </tr>
        <tr>
          <td>Image</td>
          <td><input type="file" name="fileImage" accept="image/jpeg, image/png, image/gif" onchange="previewImage(this)" /></td>
        </tr>
        <tr>
          <td>Category</td>
          <td>
            <select id="cmbCategory" name="cmbCategory">
              <?php foreach ($cates as $cate) { ?>
                <option value="<?= $cate->ID ?>"><?= $cate->Name ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" formaction="addproduct" value="ADD NEW" />
            <input type="submit" formaction="updateproduct" value="UPDATE" id="btnUpdate" style="display:none" />
            <input type="submit" formaction="deleteproduct" value="DELETE" id="btnDelete" style="display:none" onclick="return confirm('ARE YOU SURE?')" />
          </td>
        </tr>
        <tr>
          <td colspan="2"><img id="imgProduct" width="300" height="300" /></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="float-clear"></div>
</body>

</html>