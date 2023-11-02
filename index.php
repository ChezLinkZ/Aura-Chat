<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login/");
    exit();
}

$username = $_SESSION["username"]; // Get the signed-in username
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    $message = $_POST["message"];
    $imagePath = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        // Handle image upload
        $imageDir = "images/uploads/";
        $imageName = $_FILES["image"]["name"];
        $imagePath = $imageDir . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Handle the message sending here
    $messages = isset($users[$username]["messages"])
        ? $users[$username]["messages"]
        : [];
    $messages[] = [
        "message" => $message,
        "image" => $imagePath,
    ];
    $users[$username]["messages"] = $messages;
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
}

echo "<script>";
echo 'var username = "' . $username . '";';
echo "</script>";
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chat - Aura</title>
    <link rel="icon" href="assets/cloaks/favicon.ico" type="image/x-icon">
</head>
<body>

    <div class="navbar">
    <img src="assets/images/logo.png" class="logo">
    <a href="backend/logout.php"><button style="width: 120px;"><img src="assets/images/logout.png"></button></a>
    <button><img src="assets/images/auraplus.png"></button>
    <button onclick="window.open('settings','_self');"><img src="assets/images/settings.png"></button>


</div>
    <div class="chat-container">
        <div class="chat" id="messages">

        </div>
    </div>
    <div class="input-box">
        <form id="message-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="input">
        <label for="image-upload">
            <img src="assets/images/add.svg" id="add-image-button">
        </label>
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="text" name="message" placeholder="Type your Message" autocomplete="off">
        <input type="file" name="image" id="image-upload" style="display: none;">
    </div>
    <button type="submit"><img src="assets/images/send.svg"></button>
</form>
    </div>
<div id="paste-container"></div>
<div class="sidebar">
  <h1>Users</h1>
  <hr>
  <div id="users-list">

  </div>
  <div id="sidebar-bottom">
<img src="profile/Bhop/pfp.png" id="sidebar-bottom-pfp"/>
    <div class="green-circle"></div>
    <div id="sidebar-bottom-username"></div>
    <div id="sidebar-bottom-status">Online</div>
    <div id="sidebar-bottom-separator"></div>
    <div class="sidebar-bottom-button" style="top: 6px;"><img src="assets/images/sidebar-settings.png" onclick="window.open('settings/', '_blank');" /></div>
    <div class="sidebar-bottom-button" style="top: 58px;"><img src="assets/images/sidebar-bottom-users.png" onclick="displayProfile(username);" /></div>
  </div>
</div>

  <div id="profile">
<div id="banner"></div>
    <img id="profile-pfp" src="assets/images/pfp.png" />

    <div id="profile-name">
      Profile Loading
    </div>
    <div id="profile-status-container">
<div class="green-circle" style="height: 12px; width: 12px;margin-right: 10px;border-width: 3px;margin-left: 10px"></div>
    <div id="profile-status">
      Status Loading
    </div></div>


    <hr>
    <span style="margin-left: 30px; font-size: 18px;">About Me</span>
    <div id="profile-bio">Bio Loading</div>
  </div>

<div id="contextMenu" class="context-menu" style="display: none">
    <ul>
        <li class="delete-message"><a href="#" onclick="clearChat()"><img src="assets/images/delete.png"/>Clear Chat</a></li>
        <li class="delete-message"><a href="#"><img src="assets/images/delete.png"/>Delete</a></li>
        <li><a href="#">Report</a></li>
    </ul>
</div>




    <script src="script.js"></script>

</body>
</html>