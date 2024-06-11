<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form in HTML and CSS |Codehal</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class"wrapper">
    <form action=""
      <h1>Login</h1>
      <div class="input-box">
        <input type="username"
        placeholder="username" required>
        <box-icon type='solid' name='user'></box-icon>

        </div>
      <div class="input-box">
        <input type="password"
        placeholder="password" required>
        <box-icon name='lock'></box-icon>
</div>
<div class="remember-forget">
  <label><input type="checkbox"> Remember me</label>
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