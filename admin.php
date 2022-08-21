<?php
require 'shortcuts/conn.php';
require 'headers/header.php';

session_start();
if(isset($_SESSION['loginname'])&&isset($_SESSION['admin'])&&($_SESSION['admin']==1)){


//list all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
?>
<tr>
<th>username</th>
<th>password</th>
<th>role</th>
<th>profile</th>
<th></th>
<th></th>

</tr>   
<?php
  while($row = mysqli_fetch_assoc($result)){
?>
<tr>
<form action="admin.php" method = "POST">
       <td><input type="text" name ="username" value="<?php echo $row['username']; ?>"></td>
        <td><input type="text" name ="password" value="<?php echo $row['password']; ?>"></td>
        <td><input type="text" name ="role" value="<?php echo $row['role']; ?>"></td>
        <td><a href="/user_profile_view?id=<?php echo $row['id'];?>"></a></td>
        <td><input type="submit" name ="submit" value="Update"></td>
        <td><input type="submit" name ="submit" value="Delete"></td>
</form>
</tr>
<?php
//update user details
if(isset($_POST['submit'])&&$_POST['submit']=="Update"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $sql = "UPDATE users SET username='$username',password='$password',role='$role' WHERE username='$username'";
    $result2 = mysqli_query($conn,$sql);
    if($result2){
    header("Refresh:0");
        echo "User updated successfully";

    }
    else{
        echo "Error";
    }
}

//delete user
if(isset($_POST['submit'])&&$_POST['submit']=="Delete"){
    $username = $_POST['username'];
    $sql = "DELETE FROM users WHERE username='$username'";
    $result3 = mysqli_query($conn,$sql);
    if($result3){
        echo "User deleted successfully";
    header("Refresh:0");

    }
    else{
        echo "Error";
    }
}
}
}
else{
    echo "No users found";
}
}
else{
    header("location:index.php");
}
?>