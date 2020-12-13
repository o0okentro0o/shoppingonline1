<html>
<head>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="customer">
  @include('customer/_menu')
  @include('customer/_inform')
  <div class="text-center">
    <h2 class="text-center">LIST PRODUCTS</h2>
    <?php foreach ($prods as $prod) { ?>
      <div class="inline">
        <figure>
          <a href="details?id=<?= $prod->ID ?>"><img src="data:image/jpg;base64,<?= $prod->Image ?>" width="300" height="300" /></a>
          <figcaption class="text-center"><?= $prod->Name ?><br />Price: <?= $prod->Price ?></figcaption>
        </figure>
      </div>
    <?php } ?>
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