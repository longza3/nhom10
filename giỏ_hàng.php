<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_details_order = $conn->prepare("DELETE FROM `details_order` WHERE cart_id = ?");
   $delete_details_order->execute([$cart_id]);
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $success_msg[] = 'đã xóa sản phẩm';
   
}

if(isset($_GET['delete_all'])){
   $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?"); 
   $select_cart->execute([$user_id]);
   if($select_cart->rowCount() > 0){
    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      $cart_id = $fetch_cart['id'];
      $delete_details_order = $conn->prepare("DELETE FROM `details_order` WHERE user_id = ? and cart_id = ?");
      $delete_details_order->execute([$user_id, $cart_id]);
    }}
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $success_msg[] = 'xoá tất cả thành công';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $total = $_POST['total'];
   $sp = $_POST['sp'];
   $update_details_order = $conn->prepare("UPDATE `details_order` SET cart_id = ?, quantity = ?, total = ? WHERE user_id = ? AND products_id = ?");
   $update_details_order->execute([$cart_id, $qty, $total, $user_id, $sp]);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ?, total = ? WHERE id = ?");
   $update_qty->execute([$qty, $total, $cart_id]);
   $success_msg[] = 'số lượng giỏ hàng được cập nhật';
}
// if(isset($_POST['pay'])){
//    $cart_id = $_POST['cart_id'];
//    $qty = $_POST['qty'];
//    $total = $_POST['total'];
//    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ?, total = ? WHERE id = ?");
//    $update_qty->execute([$qty, $total, $cart_id]);
//    header('location:thanh_toán.php');
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>giỏ hàng</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="cart-bg">
   <section class="shopping-cart products">

      <h3 class="heading">giỏ hàng</h3>

      <div class="box-container">

         <?php
            $update_quantity_sp = 0;
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
               while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                  $post_sp = $fetch_cart['sp'];
                  $count_products_quantity_sp = $conn->prepare("SELECT * FROM `products` WHERE id = ? ");
                  $count_products_quantity_sp->execute([$post_sp]);
                  $total_products_quantity_sp = $count_products_quantity_sp->rowCount();
                     while($total_quantity_sp = $count_products_quantity_sp->fetch(PDO::FETCH_ASSOC)){
                        $update_quantity_sp = $total_quantity_sp['quantity_sp'] - $fetch_cart['quantity'];
                        
                     
         ?>
         <form action="" method="post" class="box-cart">
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>" >
            <input type="hidden" name="sp" value="<?= $fetch_cart['sp']; ?>" >
            <input type="hidden" name="total" value="<?= $sub_total =($fetch_cart['price'] * $fetch_cart['quantity']); ?>" >
            <a href="<?= $fetch_cart['key_word_sp']; ?>.php?sp=<?= $fetch_cart['sp']; ?>">
            <img src="kho_ảnh/<?= $fetch_cart['image']; ?>" alt="" id="img">
            <div class="name"><?= $fetch_cart['name']; ?></div>
            </a>
            <div class="price"><?= number_format($fetch_cart['price']); ?>₫</div>
            <div class="flex">
               <div class="flex-qty">
                  <input type="number" name="qty" class="qty" min="1" max="<?= $total_quantity_sp['quantity_sp']; ?>" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                  <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  
               </div>
               <input type="hidden" name="quantity_sp" value="<?= $total_quantity_sp['quantity_sp']; ?> " >
               <!-- <div class="sub-total"><span>Còn sản phẩm</span> </div> -->
            </div>
            <div class="sub-total"><span><?= number_format($sub_total = ($fetch_cart['price'] * $fetch_cart['quantity'])); ?>₫</span> </div>
            <input type="submit" value="xóa sản phẩm" onclick="return confirm('xóa sản phẩm này khỏi giỏ hàng?');" class="delete-btn" name="delete">
            
         </form>
         <?php
         $grand_total += $sub_total;
                     }
            }
         }else{
            echo '<p class="empty">Giỏ của bạn trống trơn!</p>';
         }
         ?>
      </div>

      <div class="cart-total">
         <p>tổng cộng : <span><?= number_format($grand_total); ?>₫</span></p>
         <a href="trang_chủ.php" class="option-btn">tiếp tục mua sắm</a>
         
         <a href="giỏ_hàng.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('bạn muốn xóa tất cả khỏi giỏ hàng?');">xóa tất cả các mục</a>
         
         <a href="thanh_toán.php"  class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">tiến hành thanh toán</a>
      </div>
   </section>
</div>













<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/alers.php'; ?>

<script src="js/script.js"></script>


</body>
</html>