<?php
include("config.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Post deleted successfully";
    $stmt->close();
}

$conn->close();
?>
