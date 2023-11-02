<?php


  $chat_backup = file_get_contents("../data/chat_backup.json");
  file_put_contents('../data/chat.json', $chat_backup);
  

?>