<?php
include("config.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $post_type = $_POST['post_type'];
    $comment = $_POST['comment'];

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    if (empty($_POST['id'])) { 
        $stmt = $conn->prepare("INSERT INTO posts (title, post_type, image, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $post_type, $target_file, $comment);
    }

    $stmt->execute();
    echo "Post saved successfully";
    $stmt->close();
}

$conn->close();
?>
