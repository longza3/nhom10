<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['order'])){
   //Lấy dữ liệu nhập vào  
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $pin_code = $_POST['pin_code'];
   $addres = ''. $_POST['flat']  .', '. $_POST['street'] .' , '. $_POST['city'] .'';
   $address = ''. $_POST['flat']  .', '. $_POST['street'] .' , '. $_POST['city'] .',  '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $total_products = $_POST['total_products'];
   $total_import_price = $_POST['total_import_price'];
   $total_price = $_POST['total_price'];
  


   $diachi = $conn->prepare("UPDATE `users` SET phone_number = ?, flat = ?, street = ? , city = ?, pin_code = ? WHERE id = ?");
   $diachi->execute([ $number, $flat, $street, $city, $pin_code, $user_id]);

   $details_order = $conn->prepare("UPDATE `details_order` SET address = ? , phone_number = ?, user_name = ? WHERE user_id = ?");
   $details_order->execute([$addres, $number, $name, $user_id]);
   // $name_email = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   // $name_email->execute([$name, $email, $user_id]);
   // Tạo đối tượng repared select cart
   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);


   

   if($check_cart->rowCount() > 0){
      
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_import_price, total_price) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_import_price, $total_price]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      
      
      // in ra tin nhắn
      $success_msg[] = 'đặt hàng thành công!';
   }else{
      // in ra tin nhắn
      $warning_msg[] = 'Giỏ của bạn trống trơn!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>
   
   <!-- link font chữ  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- link css -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">
   <?php
               $name_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? ");
               $name_user->execute([$user_id]);
                  while($name_user_sp = $name_user->fetch(PDO::FETCH_ASSOC)){
      ?>
      <input type="hidden" name="user_id" value="<?= $name_user_sp['name'] ?>">
      <?php

                        }
      ?>
   <h3>đơn hàng của bạn</h3>
   
      <div class="display-orders">
      <?php
         $update_quantity_sp = 0;
         // tạo 1 biến và cho giá trị = 0
         $grand_total = 0;
         $grand_total_import_price = 0;
         // tạo 1 biến dữ liệu dạng mảng
         $cart_items[] = '';


         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $post_sp = $fetch_cart['sp'];
               $post_name = $fetch_cart['name'];
               $ttsp = $fetch_cart['price'] * $fetch_cart['quantity'];
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') = '.$ttsp.'đ ----- ';
               $total_products = implode($cart_items);
               // tính  tổng 
               $grand_total_import_price += ($fetch_cart['import_price'] * $fetch_cart['quantity']);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               $update_quantity_sp = 0;
               $count_products_quantity_sp = $conn->prepare("SELECT * FROM `products` WHERE id = ? ");
               $count_products_quantity_sp->execute([$post_sp]);
               // $total_products_quantity_sp = $count_products_quantity_sp->rowCount();
               while($total_quantity_sp = $count_products_quantity_sp->fetch(PDO::FETCH_ASSOC)){
                  $update_quantity_sp = $total_quantity_sp['quantity_sp'] - $fetch_cart['quantity'];
      ?>
       
         <p> <?= $fetch_cart['name']; ?> <span>(<?= ''.number_format($fetch_cart['price']).'₫  x '. $fetch_cart['quantity'] .' Sản phẩm'; ?>) = <?= number_format($ttsp).'₫ '; ?></span></p>
         

         
         <input type="text" name="product_id">
    
      <?php
                  }
            }
         }else{
            echo '<p class="empty">Giỏ của bạn trống trơn!</p>';
         }
      ?>
         
         
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" >
         <input type="hidden" name="total_import_price" value="<?= $grand_total_import_price; ?>" >
         <input type="hidden" name="quantity" value="<?= $total_products; ?>">
         <!-- in ra tổng số tiền cần thanh toán -->
         <div class="grand-total">Tổng cộng : <span><?= number_format($grand_total); ?>₫ </span></div>
      </div>
     
      

      <h3>thông tin đặt hàng của bạn</h3>

      <div class="flex">
         <div class="inputBox">
            <span>tên của bạn :</span>
            <input type="text" name="name" placeholder="nhập tên của bạn" class="box" maxlength="20" required value="<?= $fetch_profile["name"]; ?>">
         </div>
         <div class="inputBox">
           
            <span>số điện thoại :</span>
            <input type="number" name="number" placeholder="nhập số điện thoại nhận hàng" value="<?= $fetch_profile["phone_number"]; ?>"  class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;"  required>
         </div>
            
         <div class="inputBox">
            <span> email của bạn :</span>
            <input type="email" name="email" placeholder="nhập email của bạn" class="box" maxlength="50" required value="<?= $fetch_profile["email"]; ?>">
         </div>
         <div class="inputBox">
            <span>phương thức thanh toán :</span>
            <select name="method" class="box" required>
               <option value="thanh toán khi giao hàng">thanh toán khi giao hàng</option>
               <option value="thẻ tín dụng">thẻ tín dụng</option>
               <option value="momo">momo</option>
               <option value="paypal">paypal</option>
               <option value="visa">visa </option>
            </select>
         </div>
         <div class="inputBox">
            <span> số nhà  :</span>
            <input type="text" name="flat" placeholder="ví dụ: số nhà"  class="box"  value="<?= $fetch_profile["flat"]; ?>" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span> huyện :</span>
            <input type="text" name="street" placeholder="ví dụ: huyện" class="box"  value="<?= $fetch_profile["street"]; ?>" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>tỉnh/thành phố :</span>
            <input type="text" name="city" placeholder="ví dụ: Hà Hội" class="box"  value="<?= $fetch_profile["city"]; ?>" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Miền :</span>
            <select name="state" class="box" required>
               <option value="bắc">bắc</option>
               <option value="trung">trung</option>
               <option value="nam">nam</option>
            </select>
         </div>
         <div class="inputBox">
            <span>quốc gia :</span>
            <input type="text" class="box"  value ="việt nam" name="country" readonly>
         </div>
         <div class="inputBox">
            <span>Mã zip :</span>
            <input type="number" min="0" name="pin_code"  value="<?= $fetch_profile["pin_code"]; ?>" placeholder="ví dụ: 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
         
      </div>
      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="đặt hàng">

   </form>

   

</section>













<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/alers.php'; ?>
<script src="js/script.js"></script>

</body>
</html>