<?php
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $post_type = $_POST['post_type'];
    $comment = $_POST['comment'];
    $image = $_FILES['image']['name'] ?? '';

    // Handle file upload if a new image is provided
    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
        $query = "UPDATE posts SET title=?, post_type=?, comment=?, image=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $title, $post_type, $comment, $image, $id);
    } else {
        $query = "UPDATE posts SET title=?, post_type=?, comment=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $title, $post_type, $comment, $id);
    }

    if ($stmt->execute()) {
        echo "Post updated successfully.";
    } else {
        echo "Error updating post: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
