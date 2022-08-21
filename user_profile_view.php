     <?php 
require 'headers/header.php';

        $id = $_GET['id'];
        $sql = "SELECT * FROM profiles WHERE user_id = $id limit 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $name = $row['full_name'];
        $email = $row['email'];
        $address = $row['address'];
        $phone = $row['bio'];
        $image = $row['picture'];
?>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo "/contact/pictures/".$image; ?>" alt="not found" height="200px" width ="200px">  
        </div>
        <div class="col-md-6">
            <h1><?php echo $name; ?></h1>
            <p><?php echo $email; ?></p>
            <p><?php echo $address; ?></p>
            <p><?php echo $phone; ?></p>
        </div>
    </div>
