<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Load user data from users.json
    $users = json_decode(file_get_contents("../data/users.json"), true);

    if (isset($users[$username]) && password_verify($password, $users[$username]["password"])) {
        // Successful login
        $_SESSION["username"] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap');

html, body {
  margin: none;
  background-image: url("../assets/images/login-background.png");
  background-size: 100%;
  background-repeat: no-repeat;
}

* {
  text-decoration: none;
}

.login-container {
  height: fit-content;
  width: fit-content;
  position: fixed;
  left: 50%;
  top: 38%;
  transform: TranslateX(-50%);
  text-align: middle;
}

h2 {
  text-align: middle;
  left: 50%;
  top: 72px;
  position: absolute;
  transform: TranslateX(-50%);
  font-family: Mulish;
  font-size: 72px;
  color: white;
  margin-bottom: 200px;
  font-weight: 100;
}

.login-inputs {
  display: block;
  
}
input {
  text-align: center;
  transform: TranslateY(-70%);
  background: none;
  border: none;
  font-family: Mulish;
  font-size: 24px;
  color: white;
  height: 30px;
  display: flex;
}

.input {
  width: 300px;
  margin-bottom: 25px;
  height: 50px;
  background-color: #101054;
  border: none;
  outline: none;
  border-radius: 4096px;
  text-align: center;
}

input:focus {
  outline: none;
  color: #fff;
}
.input img {
  height: 30px;
  width: auto;
  margin-top: 10px;
  margin-left: 20px;
  transform: TranslateY(+10px);
}
.input * {
  display: flex;
}

button {
  width: 130px;
  margin-bottom: 25px;
  height: 35px;
  background-color: #101054;
  border: none;
  outline: none;
  border-radius: 4096px;
  color: white;
  font-family: Mulish;
  text-align: left;
  padding-left: 40px;
  left: 50%;
  position: relative;
  transform: TranslateX(-50%) TranslateY(+100%);
  cursor: pointer;
}

.current-switch {
  width: 130px;
  margin-bottom: 25px;
  height: 40px;
  background-color: #101054;
  border: none;
  outline: none;
  border-radius: 4096px;
  color: white;
  font-family: Mulish;
  text-align: left;
  font-size: 30px;
  text-decoration: none;

}

.current-switch a {
  font-size: 28px;
}

.inactive-button {
  background: none;
  
}
.inactive-button a {
  color: white;
  font-size: 28px;
}
.login-switch {
  position: absolute;
  right: 150px;
  
}

.login-switch button {
  height: 40px;
  padding-left: 30px;
}

button:hover {
  cursor: pointer;
}
a:visited {
  color: white;
}

.signup-container {
  height: fit-content;
  width: fit-content;
  position: fixed;
  left: 50%;
  top: 38%;
  transform: TranslateX(-50%);
  text-align: middle;
}

input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus, 
input:-webkit-autofill:active{
    -webkit-box-shadow: 0 0 0 30px rgba(0,0,0,0) inset !important;
}
    </style>
  
  
</head>
<body>
  <div class="login-switch"><button class="inactive-button"><a href="../signup/">Signup</a></button><button style="float: right;" class="current-switch"><a href="index.php">Login</a></button></div>
  <h2>Login</h2>
    <div class="login-container">
        <form action="index.php" method="post" class="login-form">
            
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="login-inputs">
            <div class="input"><img src="../assets/images/user-icon.png"><input type="text" name="username" placeholder="Username" required></div><br>
            <div class="input"><img src="../assets/images/lock-icon.png"><input type="password" name="password" placeholder="Password"  required></div><br>
            <button type="submit">Log In<span style="margin-left: 30px;">➤</span></button><br>
              
            </div>
        </form>
    </div>
</body>
</html>
