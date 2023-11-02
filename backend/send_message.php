<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    if (!isset($_SESSION["username"])) {
        http_response_code(403); // Forbidden
        exit("Access denied. You must be logged in to send messages.");
    }
    $username = $_POST["username"];
    $message = $_POST["message"];
    $reply = $_POST["reply"];
    $date = $_POST["time"];
    // Load existing messages from chat.json
    $messages = json_decode(file_get_contents("../data/chat.json"), true);
  if ($username != $messages[count($messages) - 1]["username"]) {
    // Add the new message to the array
    $newMessage = ["username" => $username, "message" => $message, "time" => $date];
    $messages[] = $newMessage;
} else {
    $newMessage = ["username" => $username, "message" => $message, "time" => $date, "reply" => $reply];
    $messages[] = $newMessage;
    /*
    $messages[count($messages) - 1]["message"] .= "<br>" . $message;*/
}

    // Save the updated messages to chat.json
    file_put_contents("../data/chat.json", json_encode($messages, JSON_PRETTY_PRINT));

    // Redirect back to the index page
    header("Location: ../index.php");
    exit();
}
?>