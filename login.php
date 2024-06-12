<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Codehal</title>
  <link rel="stylesheet" href="css/main.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <label for="username">Username</label>
        <input type="username" placeholder="username" name="username" required>
        <box-icon type='solid' name='user'></box-icon>

        </div>
      <div class="input-box">
        <label for="password">Password</label>
        <input type="password" placeholder="password" name="password" required>
        <box-icon name='lock'></box-icon>
</div>
<div class="remember-forget">
  <label><input type="checkbox" required> Remember me</label>
  <a href="#">Forget password?</a>
</div>

<button type="submit" class="btn">Login</button>

  <div class="register-link">
    <p>Don't have an account? <a href="#">Register</a></p>
  </div>

</form>
</div>
</body>
</html>

