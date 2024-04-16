<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:đơn_hàng.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đơn hàng</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="oders-bg">
   <section class="shopping-cart products">

      <h3 class="heading">đơn hàng</h3>

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> id đơn</div>
            <div class="name"> Tên khách hàng</div>
            <div class="sdt"> Số điện thoại</div>
            <div class="ngay"> Ngày</div>
            <div class="sub-total" style="color: #fff;"> Tình trạng đơn hàng</div>
            <a href="#" style="color: #fff;">---</a>
            <a href="#" style="color: #fff;">---</a>
            
         </form>
         <?php
             if($user_id == ''){
               echo '<p class="empty">vui lòng đăng nhập để xem đơn đặt hàng của bạn</p>';
            }else{
               $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
               $select_orders->execute([$user_id]);
               if($select_orders->rowCount() > 0){
                  while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart">
            <div class="id"> <?= $fetch_orders['id']; ?></div>
            <div class="name"> <?= $fetch_orders['name']; ?></div>
            <div class="sdt"><span><?= $fetch_orders['number']; ?></div>
            <div class="ngay"><?= $fetch_orders['date']; ?></div>
            <div class="sub-total"><span style="color:<?php if($fetch_orders['payment_status'] == 'chưa giải quyết'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span>  </div>
            <a href="chi_tiết_đơn_hàng.php?dh=<?= $fetch_orders['id']; ?>">chi tiết</a>
            <a href="đơn_hàng.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn <?= ($fetch_orders['payment_status'] != 'hoàn thành')?'':'disabled'; ?>" onclick="return confirm('bạn muốn hủy đơn đặt hàng này?');">Hủy</a>
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có đơn đặt hàng!</p>';
         }
         }
         ?>
      </div>
   </section>
</div>












<?php include 'components/cuối_trang_user.php'; ?>

<script src="js/script.js"></script>

</body>
</html>