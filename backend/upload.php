<?php
if ($_FILES["image"]["error"] === 0) {
    // Define the directory where you want to store uploaded files
    $uploadDir = "..//data/uploads/";

    // Generate a unique filename for the uploaded file
    $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $targetFilePath = $uploadDir . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Return the generated filename in the response
        echo json_encode(["success" => true, "fileName" => $fileName]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to move the uploaded file."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "File upload error."]);
}
?>
