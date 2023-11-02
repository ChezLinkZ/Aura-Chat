<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "edit_message") {
            // ... (empty)
        } elseif ($_POST["action"] === "view_logs") {
            // ... (empty)
        } elseif ($_POST["action"] === "other_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "clear_logs") {
            // ... (empty)
        } elseif ($_POST["action"] === "reset_messages") {
            // ... (clear messages)
        } elseif ($_POST["action"] === "disable_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "enable_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "maintenance_mode") {
            // ... (empty)
        } elseif ($_POST["action"] === "test_message") {
            $testMessageContent = $_POST["test_message_content"];
            $testMessage = array(
                "username" => "Console",
                "message" => $testMessageContent
            );

            $chatFilePath = 'chat.json'; // file
            $chatData = json_decode(file_get_contents($chatFilePath), true);
            $chatData[] = $testMessage;

            file_put_contents($chatFilePath, json_encode($chatData));

            echo "Test message sent successfully";
        } elseif ($_POST["action"] === "clear_chat") {
            $chatFilePath = 'chat.json'; // file
            file_put_contents($chatFilePath, json_encode([])); // json array

            echo "Chat cleared successfully";
        } elseif ($_POST["action"] === "delete_all_users") {
            // ... (delete users)
        } elseif ($_POST["action"] === "create_account") {
            // ... (create account)
        }
        // idk
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dev Panel</title>
    <style>
        body {
            background-color: black;
            color: green;
            font-family: 'Consolas', monospace;
        }
        .container {
            padding: 20px;
        }
      #console {
        height: 100px;
        width: 100vw;
        white-space: pre;
      }
      #console:focus {
        border: none;
        outline: none;
      }
    </style>
</head>
<body>
  
  
    <div id="console" contenteditable="true">This is the console.</div>


  <script>
var consoleElem = document.getElementById("console");
var debug = null;
function main() {
  let consoleRaw = consoleElem.innerHTML;
  let lines = consoleRaw.split('<br>');
  lines = lines.map(line => line.trim()); // Remove leading/trailing whitespace
  let tokens = lines[lines.length - 1].split(" ");
  debug = tokens;
  const result = command(tokens);
  
  // Save the current selection
  const savedSelection = saveSelection();

  // Append the result to the div
  consoleElem.innerHTML += result;

  // Restore the selection
  restoreSelection(savedSelection);
}

const editableDiv = document.getElementById('console');

// Prevent Enter key from creating a new div element
editableDiv.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
    document.execCommand('insertHTML', false, '<br><br>');
    main();
  }
});

function command(tokens) {
  return tokens;
}

function saveSelection() {
  const selection = window.getSelection();
  const range = selection.getRangeAt(0);
  return {
    range: range,
    startContainer: range.startContainer,
    startOffset: range.startOffset,
    endContainer: range.endContainer,
    endOffset: range.endOffset,
  };
}

function restoreSelection(savedSelection) {
  const selection = window.getSelection();
  const range = document.createRange();
  range.setStart(savedSelection.startContainer, savedSelection.startOffset);
  range.setEnd(savedSelection.endContainer, savedSelection.endOffset);
  selection.removeAllRanges();
  selection.addRange(range);
}


  </script>
</body>
</html>

<style>
input[type="text"],
input[type="password"],
input[type="button"]:hover,
textarea,
button,
button:hover {
    background-color: black;
    border: 2px solid white;
    color: white;
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s; /* transition */
}

input[type="button"]:hover,
button:hover {
    border-color: green; /* border on hover */
}




  /* ===== Scrollbar CSS ===== */
  /* Firefox */
  * {
    scrollbar-width: none;
    scrollbar-color: #00ff1e #000000;
  }

  /* Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 22px;
  }

  *::-webkit-scrollbar-track {
    background: #000000;
  }

  *::-webkit-scrollbar-thumb {
    background-color: #00ff1e;
    border-radius: -19px;
    border: 5px solid #000000;
  }
</style>