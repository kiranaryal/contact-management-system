//edit user_contacts
<?php
require 'headers/header.php';
require 'shortcuts/profile.php';



define ('SITE_ROOT', realpath(dirname(__FILE__)).'/files/');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id = $_POST['id'];
    
    if(isset($_FILES['file']['name'])){
    $file = $_FILES['file']['name'];
    $file_type=$_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
    $file_tem_loc=$_FILES['file']['tmp_name'];
    $file_store=basename($_FILES['file']['name']);
$allowed = array('pdf', 'doc', 'docx');
$ext = pathinfo($file, PATHINFO_EXTENSION);
if (in_array($ext, $allowed)) {
    

    if(move_uploaded_file($file_tem_loc,SITE_ROOT.$file_store)){
        echo "Uploaded Successfully";
    }
    if(move_uploaded_file($file_tem_loc,SITE_ROOT.$file_store)){
        echo "Uploaded Successfully";
    }
    
    else{
        echo "Error";
    }
}
    }
    else{
        $file_store = $_POST['old_file'];
    }
    $sql = "UPDATE user_contacts SET name='$name',email='$email',phone='$phone',address='$address',document='$file_store' WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "Successfully updated";
    header("Location: add_contacts.php");

    }
    else{
        echo "Error";
    }
}
if(isset($_GET['id'])){
$sql = "SELECT * FROM user_contacts where id=".$_GET['id'];"";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
?>
<form action="edit_contacts.php" enctype="multipart/form-data" method="post">
    <input type="text" name="name" placeholder="<?php echo $row['name']; ?>" value="<?php echo $row['name']; ?>">
    <input type="text" name="email" placeholder="<?php echo $row['email']; ?>" value="<?php echo $row['email']; ?>">
    <input type="text" name="address" placeholder="<?php echo $row['address']; ?>" value="<?php echo $row['address']; ?>">
    <input type="text" name="phone" placeholder="<?php echo $row['phone']; ?>" value="<?php echo $row['phone']; ?>">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="old_file" value="<?php echo $row['document']; ?>">

    <input type="file" name="file" accept=".pdf,.doc,.docx">
    <input type="submit" name="submit" value="Update">
</form>
<?php
        }

    }
}

?>