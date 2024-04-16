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

<section class="orders">

   <h1 class="heading"> chi tiết đơn hàng</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">vui lòng đăng nhập để xem đơn đặt hàng của bạn</p>';
      }else{
         $dh = $_GET['dh'];
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
         $select_orders->execute([$dh]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
      <div class="box">
         <p>đặt ngày: <span><?= $fetch_orders['date']; ?></span></p>
         <p>tên : <span><?= $fetch_orders['name']; ?></span></p>
         <p>email : <span><?= $fetch_orders['email']; ?></span></p>
         <p>số điện thoại : <span><?= $fetch_orders['number']; ?></span></p>
         <p>địa chỉ : <span><?= $fetch_orders['address']; ?></span></p>
         <p>phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span></p>
         <p>đơn đặt hàng của bạn : <span><?= $fetch_orders['total_products']; ?></span></p>
         <p>Tổng giá : <span><?= number_format($fetch_orders['total_price']); ?>₫</span></p>
         <p> tình trạng thanh toán : <span style="color:<?php if($fetch_orders['payment_status'] == 'chưa giải quyết'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
         <a href="đơn_hàng.php?delete=<?= $fetch_orders['id']; ?>" onclick="return confirm('bạn có muốn hủy đơn này không!')" class="delete-btn <?= ($fetch_orders['payment_status'] != 'hoàn thành')?'':'disabled'; ?>"  >hủy đơn</a>
      </div>
      <?php
      }
      }else{
         echo '<p class="empty">chưa có đơn đặt hàng!</p>';
      }
      }
   ?>
   </div>

</section>











<?php include 'components/cuối_trang_user.php'; ?>

<script src="js/script.js"></script>

</body>
</html>