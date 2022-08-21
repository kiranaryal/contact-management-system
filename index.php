<?php
require 'headers/header.php';
require 'shortcuts/profile.php';
?>
<a href="logout.php">logout</a>

<?php
// list all user_contacts
echo "<h1>Your Contacts</h1>";
$sql = "SELECT * FROM user_contacts";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $row['name']."<br>";
        echo $row['email']."<br>";
        echo $row['address']."<br>";
        echo $row['phone']."<br>";
    }
}

?>

