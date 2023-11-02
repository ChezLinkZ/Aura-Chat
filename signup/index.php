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

    if (!isset($users[$username])) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add user to users.json
        $users[$username] = ["password" => $hashedPassword];
        file_put_contents("../data/users.json", json_encode($users, JSON_PRETTY_PRINT));
if (!file_exists('profile/'.$username)) {
    mkdir(('../profile/'.$username), 0777, true);
    $mainFile = fopen("../profile/".$username."/profile.json", "w");
    $profileData = array(
      "status" => "",
      "role" => "Member",
      "bio" => "I am new to Aura.",
      "banner" => "#7a7a9d",
      "theme" => 0,
      "premium" => false
    );

    copy("../assets/images/pfp.png", '../profile/'.$username.'/pfp.png');
  
    fwrite($mainFile, json_encode($profileData));
    
}
        $_SESSION["username"] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Username already taken";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../login/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>
  
    <div class="login-switch"><button class="current-switch"><a href="index.php">Signup</a></button><button class="inactive-button" style="margin-left: 50px;"><a href="../login/">Login</a></button></div>
    <h2>Sign Up</h2>
    <div class="login-container">
        <form action="index.php" method="post" class="login-form">
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="login-inputs">
                <div class="input">
                    <img src="images/user-icon.png">
                    <input type="text" name="username" placeholder="Username" maxlength=24 required>
                </div><br>
                <div class="input">
                    <img src="images/lock-icon.png">
                    <input type="password" name="password" placeholder="Password" required>
                </div><br>
                <button type="submit">Sign Up<span style="float: right;">➤</span></button><br>
            </div>
        </form>
    </div>
</body>
</html>
