
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Form </title>
</head>
<body>
    <div class="container">
   <div class="wrapper">
    <form action="" method="POST">
  
    <img src="../assets/logo.png" >
    <h1>Himalaya Darshan Form</h1>
      <p>please enter your details into the fields below.</p>

      <div class="input-box">
          <label for="firstname">FIRST NAME</label><br></br>
          <input type="firstname" placeholder="firstname" name="firstname" required>
      </div><br></br>
      <div class="input-box">
          <label for="middlename">MIDDLE NAME</label><br></br>
          <input type="middletname" placeholder="middlename" name="middlename" required>
      </div><br></br>
      <div class="input-box">
        <label for="lastname">LAST NAME</label><br></br>
        <input type="lastname" placeholder="lastname" name="lastname" required>
      </div><br></br>
      <div class="input-box">
        <label for="username">Username</label><br></br>
        <input type="username" placeholder="username" name="username" required>
      </div><br></br> 
      <div class="input-box">
        <label for="phone">CONTACT NUMBER</label><br></br>
        <input type="phone" placeholder="phone" name="phone" required>
      </div><br></br>
      <div class="input-box">
        <label for="programs">PROGRAM</label><br></br>
        <input type="programs" placeholder="programs" name="programs" required>
      </div><br></br>
      <button type="submit" class="btn">Apply</button>

<div class="register-link">
  <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>
</body>
</html>