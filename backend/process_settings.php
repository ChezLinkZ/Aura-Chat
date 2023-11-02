<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_SESSION["username"];

    // Get the selected theme from the JSON data

  $usersFile = json_decode(file_get_contents("../users.json"), true);

  
  
    $usersFile[$username]["theme"] = $_POST["theme"];

  file_put_contents("../users.json", json_encode($usersFile, JSON_PRETTY_PRINT));
}
  header("Location: ../index.php");
?>
