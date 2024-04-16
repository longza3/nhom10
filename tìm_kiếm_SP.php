<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/kt_giỏ_hàng.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>trang tìm kiếm</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="tìm kiếm ở đây..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            $post_id = $fetch_product['id'];

               $total_ratings = 0;
               $select_ratings = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
               $select_ratings->execute([$fetch_product['id']]);
               $total_review = $select_ratings->rowCount();
               while($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)){
                     $total_ratings += $fetch_rating['rating'];
               }
               if($total_review != 0){
                  $average = round($total_ratings / $total_review, 1);
               }else{
                  $average = 0;
               }
      
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="sp" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="quantity_sp" value="<?= $fetch_product['quantity_sp']; ?>">
      <input type="hidden" name="key_word" value="<?= $fetch_product['key_word']; ?>">
      <input type="hidden" name="import_price" value="<?= $fetch_product['import_price']; ?>">
      <input type="hidden" name="discount" value="<?= $fetch_product['discount']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <a href="<?=  $fetch_product['key_word']; ?>.php?sp=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="kho_ảnh/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?> </div>
      <div class="flex">
         <div class="price"><?= number_format($fetch_product['discount']); ?><span>₫</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <div class="dis">
         <div class="price1"><?= number_format($fetch_product['price']); ?><span>₫</span></div>
         <small><?= $km =  round((($fetch_product ['discount'] - $fetch_product ['price']) / $fetch_product ['price']) * 100) ; ?>%</small>
      </div>
      <p class="total-reviews"><span><?= $average ?></span> <i class="fas fa-star"> <span>(<?= $total_review; ?>)</span></i> </p>
      <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">không tìm thấy sản phẩm!</p>';
      }
   }
   ?>

   </div>

</section>












<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/alers.php'; ?>
<script src="js/script.js"></script>

</body>
</html>