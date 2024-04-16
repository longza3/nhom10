<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tài khoản admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
<div class="accounts-bg">
   <section class="shopping-cart products">

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id </div>
            <div class="name"> Tài khoản</div>
            <a href="#" class="option-btn" style="color: #fff;background-color: black;">---</a>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_accounts = $conn->prepare("SELECT * FROM `admins` ");
               $select_accounts->execute();
               if($select_accounts->rowCount() > 0){
                  while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_accounts['id']; ?></div>
            <div class="name"> <?= $fetch_accounts['name']; ?></div>
           
               <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('bạn có muốn xóa?')" class="delete-btn <?= ($fetch_accounts['name'] != 'admin')?'':'disabled'; ?>">xóa</a>
               <?php
                  if($fetch_accounts['id'] == $admin_id){
                     echo '<a href="update_profile.php" class="option-btn">sửa</a>';
                  }
               ?>
            
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có khách hàng nào!</p>';
         }
         
         ?>
      </div>
   </section>
</div>













<script src="../js/admin_script.js"></script>
   
</body>
</html>