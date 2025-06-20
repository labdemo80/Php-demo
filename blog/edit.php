<?php 
include 'db.php';
if (!isset($_SESSION['id'])) {
    header("Location:login.php");
    exit;
}
$id = $_GET['id'];
$user_id = $_SESSION['id'];
// Use prepared statement instead of direct query
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
if (!$blog) {
    die("Unauthorized Access");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image_name");
    } else {
        $image_name = $blog['image']; // Keep existing image
    }
    $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ?, image = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param('sssii', $title, $content, $image_name, $id, $user_id);
    $stmt->execute();
    header("Location:dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Enter Title</label>
        <input type="text" name="title" value="<?= $blog['title'] ?>"><br>

        <label>Content</label>
        <textarea name="content"><?= $blog['content'] ?></textarea><br>

        <label>Image</label><br>
        <img src="uploads/<?= $blog['image'] ?>" width="300" alt=""><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Update</button>
        <a href="dashboard.php">Back To Dashboard</a>
    </form>
</body>
</html>
