<?php
require 'headers/header.php';
require 'shortcuts/profile.php';
?>

<a href="logout.php">logout</a>

<?php
// show user profile
echo "<h1>Your Profile</h1>";
define ('SITE_ROOT', realpath(dirname(__FILE__)).'/pictures/');

$loginname = $_SESSION['loginname'];
$sql = "SELECT * FROM users WHERE username='$loginname' limit 1";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
   $row = mysqli_fetch_array($result);
$id = $row['id'];
$sql = "SELECT * FROM profiles WHERE user_id='$id'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
$full_name = $row['full_name'] ?? ""; 
$email = $row['email'] ?? "";
$address = $row['address'] ?? "";
$bio = $row['bio'] ?? "";
$picture = $row['picture'] ?? ""; 
}
}
?>

 

<form action="user_profile.php" method="post" enctype="multipart/form-data">
 
    fullname:<input type="text" name="full_name" value="<?php echo $full_name; ?>"> <br>
    email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
    address:<input type="text" name="address" value="<?php echo $address; ?>"><br>
    bio:<input type="text" name="biography" value="<?php echo $bio; ?>"><br>
    profile pic<input type="file" name="picture" value="<?php echo $picture; ?>"><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit" value="submit">
</form>
<img src="<?php echo "/contact/pictures/".$picture; ?>" alt="not found" height="200px" width ="200px">
<?php

if(isset($_POST['submit'])){
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$biography = $_POST['biography'];
$id = $_POST['id'];

if(isset($_FILES['picture']['name'])){
    $file = $_FILES['picture']['name'];
    $file_type=$_FILES['picture']['type'];
    $file_size=$_FILES['picture']['size'];
    $file_tem_loc=$_FILES['picture']['tmp_name'];
    $file_store=basename($_FILES['picture']['name']);
$allowed = array('jpeg', 'jpg', 'png');
$ext = pathinfo($file, PATHINFO_EXTENSION);
if (in_array($ext, $allowed)) {
    

    if(move_uploaded_file($file_tem_loc,SITE_ROOT.$file_store)){
    }
    else{
        echo "Error";
    }

}
else{
    echo "File type not allowed";
}
}

$sql = "UPDATE profiles SET full_name='$full_name',email='$email',address='$address',bio='$biography',picture='$file_store' WHERE user_id='$id'";
$result = mysqli_query($conn,$sql);
if($result){
}
else{
    echo "Error";
}
}
?>