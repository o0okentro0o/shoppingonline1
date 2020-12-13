<html>

<head>
<title>Login</title>
  <link href="{{ asset('css/styles.css') }}" type="text/css" rel="stylesheet" />
</head>

<body class="admin">
  <div class="align-valign-center">
    <h2 class="text-center">ADMIN LOGIN</h2>
    <form action="login" method="POST">
      @csrf
      <table class="align-center">
        <tr>
          <td>Username</td>
          <td><input type="text" name="txtUsername" value="" required /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="txtPassword" value="" required /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="btnSubmit" value="LOGIN" /></td>
        </tr>
      </table>
    </form>
  </div>
</body>

</html>