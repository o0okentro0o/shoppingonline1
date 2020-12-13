<div class="border-bottom">
  <div class="float-left">
    <ul class="menu">
      <li class="menu"><a href="home">Home</a></li>
      <?php if (isset($cates)) {
        foreach ($cates as $cate) { ?>
          <li class="menu"><a href="listproduct?cateid=<?= $cate->ID ?>"><?= $cate->Name ?></a></li>
      <?php }
      } ?>
    </ul>
  </div>
  <div class="float-right">
    <form action="search" method="POST" class="search">
      @csrf
      <input type="search" name="txtKeyword" placeholder="Enter keyword" class="keyword" required oninvalid="this.setCustomValidity('Keyword cannot be empty')" oninput="this.setCustomValidity('')" />
      <input type="submit" value="SEARCH" />
    </form>
  </div>
  <div class="float-clear"></div>
</div>