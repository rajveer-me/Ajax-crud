<?php
include("config.php");


$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['post_type']) . "</td>";
        echo "<td><img src='" . htmlspecialchars($row['image']) . "' width='100' /></td>";
        echo "<td>" . nl2br(htmlspecialchars($row['comment'])) . "</td>";
        echo "<td>
                <button class='edit-btn' data-id='" . $row['id'] . "'>Edit</button>
                <button class='delete-btn' data-id='" . $row['id'] . "'>Delete</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No posts found.</td></tr>";
}

$conn->close();
?>
