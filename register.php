<?php
require 'headers/header.php';
require 'shortcuts/session.php';

if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password2'])&&isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "Username already exists";
    }
    else{
    if($password==$password2){
        $sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
        $result = mysqli_query($conn,$sql);

        if($result){
            $sql = "SELECT * FROM users WHERE username='$username' limit 1";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $id = $row['id'];
            $sql = "insert into profiles (user_id) values ('$id')";
            $result = mysqli_query($conn,$sql);
            header("location:login.php?action=registered successfully");
        }
        else{
            echo "Error";
        }
    }
    else{
        echo "Passwords do not match";
    }
    }
    }
   


?>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="password2" placeholder="Confirm Password">
    <input type="submit" name="submit" value="Register">
</form>
<?php
require_once 'headers/footer.php';
?>