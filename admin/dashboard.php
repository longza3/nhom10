<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>bảng điều khiển</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body >

<?php include '../components/admin_header.php'; ?>

<section class="dashboard" >

   <h1 class="heading">bảng điều khiển</h1>

   <div class="box-container">

      <div class="box">
         <h3>xin chào!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">sửa thông tin</a>
      </div>

      <!-- tổng số tiền thanh toán chưa giải quyết -->
      


      <!-- tổng số tiền thanh toán hoàn thành-->
      



      

      

      <div class="box" style="background-color: #CD5555;" >
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3 style="color: #000000;"><?= $number_of_orders; ?></h3>
         <p>đơn hàng</p>
         <a href="đơn_hàng.php" class="btn">xem đơn đặt hàng</a>
      </div>

      <div class="box" style="background-color: #367517;">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3 style="color: #fff;"><?= $number_of_products; ?></h3>
         <p>sản phẩm thêm vào web</p>
         <a href="products.php" class="btn">xem sản phẩm</a>
      </div>

      <div class="box" style="background-color: #C0C0C0;">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3 style="color: #000000;"><?= $number_of_users; ?></h3>
         <p>người dùng</p>
         <a href="ql_người_dùng.php" class="btn">xem người dùng</a>
      </div>

      <div class="box" style="background-color: #990000;">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3 style="color: #fff;"><?= $number_of_admins; ?></h3>
         <p>người dùng admin</p>
         <a href="admin_accounts.php" class="btn">xem admin</a>
      </div>

      <div class="box" style="background-color: #A2007C;">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3 style="color: #fff;"><?= $number_of_messages; ?></h3>
         <p>các tin nhắn mới</p>
         <a href="messages.php" class="btn">xem tin nhắn</a>
      </div>
      <div class="box" style="background-color: #ECAB53;">
         <?php
            $select_reviews = $conn->prepare("SELECT * FROM `reviews`");
            $select_reviews->execute();
            $number_of_reviews = $select_reviews->rowCount()
         ?>
         <h3 style="color: #000000;"><?= $number_of_reviews; ?></h3>
         <p>đánh giá</p>
         <a href="reviews.php" class="btn">xem reviews</a>
      </div>
   

   </div>
  

</section>












<script src="../js/admin_script.js"></script>
<!-- <script>
var today = new Date();
var date = (today.getMonth()+1)+'-'+today.getFullYear();
 
document.getElementById("hvn").innerHTML = date;
</script> -->
   
</body>
</html>