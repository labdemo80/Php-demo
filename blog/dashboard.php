<?php 

include 'db.php';

if (! isset ($_SESSION['id'])) {
    header("Location:login.php");
    exit;
}
$user_id=$_SESSION['id'];
$result=$conn->query("SELECT blogs .*,user.username from blogs join user on blogs.user_id=user.id");
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <a
                name=""
                id=""
                class="btn btn-primary"
                href="logout.php"
                role="button"
                >Logout</a
            >
            <a
                name=""
                id=""
                class="btn btn-primary"
                href="addblog.php"
                role="button"
                >Add Blog</a
            >

            <?php 
            while ($row=$result->fetch_assoc()) {?>
                <div
                    class="container" style="border:2px solid black; margin:20px">
                    <h2><?= $row['title']?></h2>
                    <small>By: <?= $row['username']?> |  <?= $row['created_at']?></small><br>
                    <img src="uploads/<?= $row['image']?>" width="300px" alt="Blog Image"><br>
                    <h4><?= $row['content']?></h4>                           
                    <?php 
                    if ($row['user_id'] ==$user_id) {?>
                    <a href="edit.php?id=<?= $row['id']?>">Edit Blog</a>
                <a href="delete.php?id=<?= $row['id']?>">Delete Blog</a>                                        
            <?php } ?>               
                </div>
                <?php }  ?>
        </main>
        <footer>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

