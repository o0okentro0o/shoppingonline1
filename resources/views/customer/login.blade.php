<html>
<head>
  <title>Login</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="customer">
  @include('customer/_menu')
  @include('customer/_inform')
  <div class="align-center">
    <h2 class="text-center">CUSTOMER LOGIN</h2>
    <form action="login" method="POST">
      @csrf
      <table class="align-center">
        <tr>
          <td>Username</td>
          <td><input type="text" name="txtUsername" required /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="txtPassword" required /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="btnSubmit" value="LOGIN" /></td>
        </tr>
        <tr>
          <td></td>
          <td><a href="signup">Sign-up</a> for a new account</td>
        </tr>
      </table>
    </form>
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