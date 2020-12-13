<html>
<head>
<title>Profile</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>
<body class="customer">
  @include('customer/_menu')
  @include('customer/_inform')
  <div class="align-center">
    <h2 class="text-center">MY PROFILE</h2>
    <form action="myprofile" method="POST">
      @csrf
      <table class="align-center">
        <tr>
          <td>Username</td>
          <td><input type="text" name="txtUsername" value="{{ Session::get('customer')->Username }}" readonly /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="txtPassword" value="{{ Session::get('customer')->Password }}" pattern=".{3,}" required /></td>
        </tr>
        <tr>
          <td>Name</td>
          <td><input type="text" name="txtName" value="{{ Session::get('customer')->Name }}" required /></td>
        </tr>
        <tr>
          <td>Phone</td>
          <td><input type="tel" name="txtPhone" value="{{ Session::get('customer')->Phone }}" pattern="0[0-9]{9}" required /></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="email" name="txtEmail" value="{{ Session::get('customer')->Email }}" readonly /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="btnSubmit" value="UPDATE" /></td>
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