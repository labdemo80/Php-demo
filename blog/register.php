<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
    $username=$_POST["username"];
    $email=$_POST["email"];
    $pass=password_hash($_POST["pass"],PASSWORD_DEFAULT);

    $sql=$conn->prepare("insert into user(username,email,password) values (?,?,?) ");
    $sql->bind_param("sss",$username,$email,$pass);
    $sql->execute();
    header("Location:login.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Username</label>
        <input type="text" name="username">
        <label for="">Email</label>
        <input type="text" name="email">
<label for="">Password</label>
<input type="password" name="pass">
<button type="submit">Submit</button>
    </form>
    
</body>
</html>