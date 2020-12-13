<div class="border-bottom">
  <div class="float-left">
    @if (Session::get('customer') != null)
    Hello <b>{{ Session::get('customer')->Name }}</b> |
    <a href="logout">Logout</a> |
    <a href="myprofile">My profile</a> |
    <a href="myorders">My orders</a>
    @else
    <a href="login">Login</a> |
    <a href="signup">Sign-up</a>
    @endif
  </div>
  <div class="float-right">
    <a href="mycart">My cart</a> have
    @if (Session::get('mycart') != null)
    <b>{{ Session::get('mycart')->getSize() }}</b>
    @else
    <b>0</b>
    @endif
    items
  </div>
  <div class="float-clear"></div>
</div>