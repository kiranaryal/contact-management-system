<?php
require 'headers/header.php';
require 'shortcuts/session.php';

if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $_SESSION['loginname']= $username;
        $row = mysqli_fetch_array($result);
if($row['role']=="1"){
    $_SESSION['admin']= true;
}
        echo "Login Successful";
        echo $_SESSION['loginname'];
        header("location:index.php?action=login successfully"); 
    }
    else{
        echo "Login Failed";
    }
 
}
?>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="submit" value="login">
</form>
<a href="register.php">Not registered yet?</a>
<?php
require_once 'headers/footer.php';
?>