<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};
// xóa tin nhắn
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tin nhắn</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>


<div class="mess-bg">
   <section class="shopping-cart products">

      <h3 class="heading">liên hệ</h3>

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id tin nhắn</div>
            <div class="name"> Tên khách hàng</div>
            <div class="email"> Email</div>
            <div class="sdt"> Số điện thoại</div>
            <div class="ngay"> Ngày nhắn</div>
            <div class="sub-total" style="color: #fff;"> Nội dung</div>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_messages = $conn->prepare("SELECT * FROM `messages` ");
               $select_messages->execute();
               if($select_messages->rowCount() > 0){
                  while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart">
            <div class="id"> <?= $fetch_messages['id']; ?></div>
            <div class="name"> <?= $fetch_messages['name']; ?></div>
            <div class="email"> <?= $fetch_messages['email']; ?></div>
            <div class="sdt"><span><?= $fetch_messages['number']; ?></div>
            <div class="ngay"><?= $fetch_messages['date_time']; ?></div>
            <div class="sub-total"> <?= $fetch_messages['message']; ?></div>
            <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick="return confirm('xóa tin nhắn này?');">xóa</a>
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có tin nhắn nào!</p>';
         }
         
         ?>
      </div>
   </section>
</div>












<script src="../js/admin_script.js"></script>
   
</body>
</html>