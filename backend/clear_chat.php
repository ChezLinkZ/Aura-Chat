<?php
$chatFilePath = '../data/chat.json';

function deleteDirectoryContents($dir) {
    if (is_dir($dir)) {
        $contents = scandir($dir);
        foreach ($contents as $item) {
            if ($item != "." && $item != "..") {
                $itemPath = $dir . '/' . $item;
                if (is_dir($itemPath)) {
                    // Recursively delete contents of subdirectories
                    deleteDirectoryContents($itemPath);
                } else {
                    // Delete files
                    unlink($itemPath);
                }
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clear the chat by overwriting chat.json with an empty array
    file_put_contents($chatFilePath, json_encode([]));
  deleteDirectoryContents("../data/uploads");
    echo 'Chat cleared successfully.';
} else {
    // Invalid request method
    http_response_code(400);
    echo 'Invalid request.';
}
?>
