<?php
// Include database connection
include 'includes/db_connect.php';

// Retrieve post ID from URL parameter
$post_id = $_GET['id'];

// Retrieve post data from database
$sql = "SELECT * FROM posts WHERE id = '$post_id'";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

// Retrieve author data from database
$author_id = $post['author'];
$sql = "SELECT * FROM authors WHERE id = '$author_id'";
$result = mysqli_query($conn, $sql);
$author = mysqli_fetch_assoc($result);

// Display post content
echo "<h1>{$post['title']}</h1>";
echo "<p>By {$author['name']} on " . date('F j, Y', strtotime($post['created_at'])) . "</p>";
echo "<img src='{$post['image']}' alt='{$post['title']}' />";
echo "<p>{$post['content']}</p>";
?>
