<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
//cập nhật đơn hàng
if(isset($_POST['update_đơn_hàng'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $success_msg[] = 'trạng thái thanh toán được cập nhật!';
}
//xóa đơn hàng
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:đơn_hàng.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>chi tiết</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>


<section class="orders">

<h1 class="heading">chi tiết đơn hàng</h1>


<div class="box-container">

   <?php
      $dh = $_GET['dh'];
      $total_doanhthu = 0;
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE `id` = ?");
      $select_orders->execute([$dh]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> đặt ngày: <span><?= $fetch_orders['date']; ?></span></p>
      <p> tên: <span><?= $fetch_orders['name']; ?></span> </p>
      <p> số điện thoại: <span><?= $fetch_orders['number']; ?></span> </p>
      <p> địa chỉ: <span><?= $fetch_orders['address']; ?></span> </p>
      <p> các sản phẩm: <span><?= $fetch_orders['total_products']; ?></span> </p>
      <div class="import_price"><p> tổng tiền giá gốc: <?= number_format($fetch_orders['total_import_price']); ?>₫</span> </p></div>
      <div class="price"><p> tổng tiền giá bán: <?= number_format($fetch_orders['total_price']); ?>₫</span> </p></div>
      <div class="dt"><p> doanh thu: <?= number_format($total_doanhthu =  $fetch_orders ['total_price'] - $fetch_orders ['total_import_price']) ;?>₫</p></div>
      <p> phương thức thanh toán: <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="chưa giải quyết">Chưa giải quyết</option>
            <option value="hoàn thành">Hoàn thành</option>
            <option value="Đang vận chuyển">Đang vận chuyển</option>
            <option value="Chờ xác nhận">Chờ xác nhận</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="cập nhật" class="option-btn" name="update_đơn_hàng">
         <a href="đơn_hàng.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('xóa đơn đặt hàng này?');">xóa</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">chưa có đơn hàng nào được đặt!</p>';
      }
   ?>

</div>

</section>

</section>











<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 
<script src="../js/admin_script.js"></script>
   
</body>
</html>