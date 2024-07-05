<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="register.css">
<title>Form </title>
<style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "poppins", Arial, Helvetica, sans-serif;
}
body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: none;
  background-size: cover;
  background-position: center;
  color: black;
}
p{
  color: #000000;
  text-align: left;
  float: left;
}
.wrapper {
  width: 600px;
  /* background-color: transparent; */
  background-color: whitesmoke;
  /* border: 2px solid rgba(255,255,255, .2); */
  /* backdrop-filter: blur(20px); */
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
  color: #fff;
   border-radius: 10px; 
   padding: 30px 40px; 
  padding: 20px;
}
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.wrapper h1 {
  font-weight: 600;
  font-size: 28px;
  text-align: center;
  color: black;
}
.wrapper .input-box {
  width: 90%;
  height: 50px;
  margin: 30px 0;
  color: black;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.input-box input {
  width: 100%px;
  height: 100%;
  background: transparent;
  outline: none;
  border: 2px solid rgba(39, 38, 38, 0.2);
  border-radius: 10px;
  font-size: 16px;
  color: #000000;
  padding: 20px 45px 20px 20px;
}
.input-box input::placeholder {
  color: rgb(17, 17, 17);
}
 /* .input-box i {
  position: absolute;
  right: 20px;
  top: 50px;
  transform: translateY(-50%);
  font-size: 20px;
}  */
.wrapper .btn {
  margin-top: 19px;
  width: 90%;
  height: 45px;
  background: #024699;
  border: none;
  outline: none;
  border-radius: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  font-size: 16px;
  color: #ffffff;
  font-weight:100px ;
}
    </style>  
</head>
<body>
    <div class="container">
   <div class="wrapper">
    <form action="" method="POST">
  
    <img src="assets/logo.png" alt="loading" title="Himalaya Darshan College">
    <h1>Himalaya Darshan College</h1>
      <p>Please enter your details into the fields below.</p>

      <div class="input-box">
          <label for="firstname">FIRST NAME</label><br></br>
          <input type="firstname" placeholder="firstname" name="firstname" required>
      </div></br>
      <div class="input-box">
          <label for="middlename">MIDDLE NAME</label><br></br>
          <input type="middletname" placeholder="middlename" name="middlename" required>
      </div></br>
      <div class="input-box">
        <label for="lastname">LAST NAME</label><br></br>
        <input type="lastname" placeholder="lastname" name="lastname" required>
      </div></br>
      <div class="input-box">
        <label for="username">Username</label><br></br>
        <input type="username" placeholder="username" name="username" required>
      </div></br> 
      <div class="input-box">
        <label for="phone">CONTACT NUMBER</label><br></br>
        <input type="phone" placeholder="phone" name="phone" required>
      </div></br>
      <div class="input-box">
        <label for="programs">PROGRAM</label><br></br>
        <select name="programs" required>
          <option value="" disabled>Select a Program</option>
          <option value="1">BIM</option>
          <option value="2">BCA</option>
          <option value="3">Bsc.Csit</option>
          <option value="4">BHM</option>
          <option value="5">BBS</option>
          </select>
      </div><br></br>
      <button type="submit" class="btn">Apply</button>

<div class="register-link">
  <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>
</body>
</html>