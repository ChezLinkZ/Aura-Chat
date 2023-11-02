<?php


  $chat_backup = file_get_contents("../data/chat.json");
  file_put_contents('../data/chat_backup.json', $chat_backup);

?>