<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['delete_review'])){

   $delete_id = $_POST['delete_id'];

   $verify_delete = $conn->prepare("SELECT * FROM `reviews` WHERE id = ?");
   $verify_delete->execute([$delete_id]);
   
   if($verify_delete->rowCount() > 0){
      $delete_review = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
      $delete_review->execute([$delete_id]);
      $success_msg[] = 'Đã xóa đánh giá!';
   }else{  
      $warning_msg[] = 'Đánh giá đã bị xóa!!';
   }

}

include 'components/kt_giỏ_hàng.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>chi tiết</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<!-- phần sản phẩm -->
<section class="quick-view">

   <h1 class="heading">chi tiết</h1>

   <?php
     $sp = $_GET['sp'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$sp]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="sp" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="quantity_sp" value="<?= $fetch_product['quantity_sp']; ?>">
      <input type="hidden" name="key_word" value="<?= $fetch_product['key_word']; ?>">
      <input type="hidden" name="import_price" value="<?= $fetch_product['import_price']; ?>">
      <input type="hidden" name="discount" value="<?= $fetch_product['discount']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="kho_ảnh/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="kho_ảnh/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="kho_ảnh/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="kho_ảnh/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
            
         </div>
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?> <span></span></div>
            <div class="all">
                <li>
                    <p class="lileft">Tương thích:</p>
                    <span class="liright"><?= $fetch_product['details_1']; ?></span>
                </li>
                <li>
                    <p class="lileft">Cách kết nối:</p>
                    <span class="liright"><?= $fetch_product['details_2']; ?></span>
                </li>
                <li>
                    <p class="lileft">Đèn LED:</p>
                    <span class="liright"><?= $fetch_product['details_3']; ?></span>
                </li>
                <li>
                    <p class="lileft">Số phím:</p>
                    <span class="liright"><?= $fetch_product['details_4']; ?></span>
                </li>
                <li>
                    <p class="lileft">Thương hiệu của:</p>
                    <span class="liright"><?= $fetch_product['details_5']; ?></span>
                </li>
                <li>
                    <p class="lileft">Hãng</p>
                    <span class="liright"><?= $fetch_product['details_6']; ?></span>
                </li>
                
                
            </div>
            <div class="flex">
               <div class="price"><?= number_format($fetch_product['discount']); ?><span>₫</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="dis">
               <div class="price1"><?= number_format($fetch_product['price']); ?><span>₫</span></div>
               <small><?= $km =  round((($fetch_product ['discount'] - $fetch_product ['price']) / $fetch_product ['price']) * 100) ; ?>%</small>
            </div>
            <div class="flex-btn">
               <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
   }
   ?>

</section>




<section class="view-post">

  

   <?php
      

      $select_post = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
      $select_post->execute([$sp]);
      if($select_post->rowCount() > 0){
         while($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)){

        $total_ratings = 0;
        $rating_1 = 0;
        $rating_2 = 0;
        $rating_3 = 0;
        $rating_4 = 0;
        $rating_5 = 0;
        

        $select_ratings = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
        $select_ratings->execute([$fetch_post['id']]);
        $total_reivews = $select_ratings->rowCount();
        while($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)){
            $total_ratings += $fetch_rating['rating'];
            if($fetch_rating['rating'] == 1){
               $fetch_rating['rating'] = 1;
               $rating_1 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 2){
               $fetch_rating['rating'] = 1;
               $rating_2 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 3){
               $fetch_rating['rating'] = 1;
               $rating_3 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 4){
               $fetch_rating['rating'] = 1;
               $rating_4 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 5){
               $fetch_rating['rating'] = 1;
               $rating_5 += $fetch_rating['rating'];
            }
        }

        if($total_reivews != 0){
            $average = round($total_ratings / $total_reivews, 1);
        }else{
            $average = 0;
        }
        
   ?> 
   <div class="heading-ct"><h1>đánh giá chi tiết sản phẩm </h1> <a href="all_bàn_phím.php" class="inline-option-btn" style="margin-top: 0;">cửa hàng bàn phím</a></div>
   <div class="row">
      <div class="col">
         <img src="kho_ảnh/<?= $fetch_post['image_01']; ?>" alt="" class="image">
         <h3 class="title">Thông tin sản phẩm</h3>
         <p><?= $fetch_post['details']; ?></p>
         <p><?= $fetch_post['details1']; ?></p>
         <p><?= $fetch_post['details2']; ?></p>
         <p><?= $fetch_post['details3']; ?></p>
         <p><?= $fetch_post['details4']; ?></p>
         <p><?= $fetch_post['details5']; ?></p>
      </div>
      
      <div class="col">
         <div class="flex">
            
            <div class="total-reviews">
               
               <h3><?= $average; ?><i class="fas fa-star"></i></h3>
               <p><?= $total_reivews; ?> đánh giá</p>
            </div>
            <div class="total-ratings">
               <p>
                  <span>(<?= $rating_5; ?>)</span>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  
               </p>
               <p>
                  <span>(<?= $rating_4; ?>)</span>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  
               </p>
               <p>
               <span>(<?= $rating_3; ?>)</span>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  
               </p>
               <p>
                  <span>(<?= $rating_2; ?>)</span>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  
               </p>
               <p>

                  <span>(<?= $rating_1; ?>)</span>
                  <i class="fas fa-star"></i>
                  
               </p>
            </div>
         </div>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">post is missing!</p>';
      }
   ?>

</section>



<section class="reviews-container">

   <div class="heading-ct"><h1>người dùng đánh giá</h1> <a href="thêm_đánh_giá.php?get_id=<?= $sp; ?>" class="inline-btn" style="margin-top: 0;">thêm đánh giá</a></div>

   <div class="box-container">

   <?php
      $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
      $select_reviews->execute([$sp]);
      if($select_reviews->rowCount() > 0){
         while($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_review['user_id'] == $user_id){echo 'style="order: -1;"';}; ?>>
      <?php
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_user->execute([$fetch_review['user_id']]);
         while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="user">
         <?php if($fetch_user['image'] != ''){ ?>
            <img src="images/<?= $fetch_user['image']; ?>" alt="">
         <?php }else{ ?>   
            <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
         <?php }; ?>   
         <div>
            <p><?= $fetch_user['name']; ?></p>
            <span><?= $fetch_review['date']; ?></span>
         </div>
      </div>
      <?php }; ?>
      <div class="ratings">
         <?php if($fetch_review['rating'] == 1){ ?>
            <p style="background:var(--white;"><span><?= $fetch_review['rating']; ?></span> <i class="fas fa-star"></i></p>
         <?php }; ?> 
         <?php if($fetch_review['rating'] == 2){ ?>
            <p style="background:var(--white);"><span><?= $fetch_review['rating']; ?></span> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
         <?php }; ?>
         <?php if($fetch_review['rating'] == 3){ ?>
            <p style="background:var(--white);"><span><?= $fetch_review['rating']; ?></span> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
         <?php }; ?>   
         <?php if($fetch_review['rating'] == 4){ ?>
            <p style="background:var(--white);"><span><?= $fetch_review['rating']; ?></span> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
         <?php }; ?>
         <?php if($fetch_review['rating'] == 5){ ?>
            <p style="background:var(--white);"><span><?= $fetch_review['rating']; ?></span> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></p>
         <?php }; ?>
      </div>
      <h3 class="title"><?= $fetch_review['title']; ?></h3>
      <?php if($fetch_review['description'] != ''){ ?>
         <p class="description"><?= $fetch_review['description']; ?></p>
      <?php }; ?>  
      <img src="kho_ảnh/<?= $fetch_review['image_rv']; ?>" alt="" style="max-width: 200px;max-height: 400px;">
      <?php if($fetch_review['user_id'] == $user_id){ ?>
         <form action="" method="post" class="flex-btn1">
            
            <input type="hidden" name="delete_id" value="<?= $fetch_review['id']; ?>">
            <a href="sửa_đánh_giá.php?get_id=<?= $fetch_review['id']; ?>" class="inline-option-btn">sửa đánh giá</a>
            <input type="submit" value="xóa đánh giá" class="inline-delete-btn" name="delete_review" onclick="return confirm('bạn muốn xóa đánh giá?');">
         </form>
      <?php }; ?>   
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">chưa có đánh giá nào được thêm vào!</p>';
      }
   ?>

   </div>

</section>
<section class="spch">
   <h1 class="heading">các sản phẩm cùng hãng </h1>
   <div class="swiper mySwiper">
    <div class="swiper-wrapper">
         <?php
          $sp = $_GET['sp'];
          $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
          $select_products->execute([$sp]);
          if($select_products->rowCount() > 0){
           while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
               $brand = $fetch_product['brand'];
               $select_products = $conn->prepare("SELECT * FROM `products` WHERE brand LIKE '%{$brand}%'"); 
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
                           $post_id = $fetch_product['id'];
                        $km = round((($fetch_product ['discount'] - $fetch_product ['price']) / $fetch_product ['price']) * 100) ;
                        
                        $total_ratings = 0;
                        $select_ratings = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
                        $select_ratings->execute([$fetch_product['id']]);
                        $total_reivews = $select_ratings->rowCount();
                        while($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)){
                              $total_ratings += $fetch_rating['rating'];
                        }
                        if($total_reivews != 0){
                           $average = round($total_ratings / $total_reivews, 1);
                        }else{
                           $average = 0;
                        }
               
                        $count_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
                        $count_reviews->execute([$post_id]);
                        $total_reviews = $count_reviews->rowCount();
            
         ?>
         <form action="" method="post" class="swiper-slide slide">
            <input type="hidden" name="sp" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="quantity_sp" value="<?= $fetch_product['quantity_sp']; ?>">
            <input type="hidden" name="key_word" value="<?= $fetch_product['key_word']; ?>">
            <input type="hidden" name="import_price" value="<?= $fetch_product['import_price']; ?>">
            <input type="hidden" name="discount" value="<?= $fetch_product['discount']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <a href="<?= $fetch_product['key_word']; ?>.php?sp=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
            <img src="kho_ảnh/<?= $fetch_product['image_01']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?> </div>
            
            <div class="flex">
               <div class="price"><?= number_format($fetch_product['discount']); ?><span>₫</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="dis">
               <div class="price1"><?= number_format($fetch_product['price']); ?><span>₫</span></div>
               <small><?= $km; ?>%</small>
            </div>
            <p class="total-reviews"><span><?= $average ?></span><i class="fas fa-star"></i> (<?= $total_reviews; ?>)  </p>
            <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
         </form>
         <?php
            }
               }
            }
         }else{
            echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
         }
         ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>














<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>
<script>
   var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
<?php include 'components/alers.php'; ?>
</body>
</html>