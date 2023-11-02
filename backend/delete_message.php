<?php
// Step 1: Receive messageId via POST
if (isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];

    // Step 2: Load chat.json into a PHP array
    $chatFile = '../data/chat.json';

    $chatData = json_decode(file_get_contents("../data/chat.json"));

  $newChatData = array();

  for ($i = 0; $i < count($chatData); $i ++) {
    if ($i != $messageId) {
      array_push($newChatData, $chatData[$i]);
    }
    
  }
  unset($chatData[messageId]);

  file_put_contents("../data/chat.json", json_encode($newChatData,JSON_PRETTY_PRINT));
} else {
    echo 'Please provide a messageId parameter via POST.';
}
?>
