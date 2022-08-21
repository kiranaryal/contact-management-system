<?php  
require 'headers/header.php';

define ('SITE_ROOT', realpath(dirname(__FILE__)).'/files/');
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

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
    else{
        echo "Error";
    }
}
    $sql = "INSERT INTO user_contacts (name,email,phone,address,document) VALUES ('$name','$email','$phone','$address','$file_store')";

    $query=mysqli_query($conn,$sql);
}
else{
echo "Please select a file";
}   
}
?>
<form action="add_contacts.php" enctype="multipart/form-data" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="address" placeholder="Address">
    <input type="text" name="phone" placeholder="Phone">
    <input type="file" name="file" accept=".pdf,.doc,.docx">
    <input type="submit" name="submit" value="Add Contact">
</form>


<?php
$sql = "SELECT * FROM user_contacts";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $row['name']."<br>";
        echo $row['email']."<br>";
        echo $row['address']."<br>";
        echo $row['phone']."<br>";
    
    ?>   
    <a href="edit_contacts.php?id=<?php echo $row['id']; ?>">edit</a>
    <a href="<?php echo 'files/'.$row['document'] ; ?>">Download</a>
    <?php
    }
}



?>

