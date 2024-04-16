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
   <title>trang chủ</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="swiper home-slider">
      
      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="image">
               <img src="images/1.png" alt="">
            </div>
            <div class="content">
               <span>giảm giá lên tới 50%</span>
               <h3>Bàn phím mới nhất</h3>
               <a href="all_dtdd.php" class="btn">mua ngay</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="image">
               <img src="images/loa-bluetooth-mozard-e7-den-3-org-removebg-preview.png" alt="">
            </div>
            <div class="content">
               <span>giảm giá lên tới 50%</span>
               <h3>loa bluetooth mới nhất</h3>
               <a href="all_loa_bluetooth.php" class="btn">mua ngay</a>
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="image">
               <img src="images/apple-macbook-pro-m2-2022-1-removebg-preview.png" alt="">
            </div>
            <div class="content">
               <span>giảm giá lên tới 50%</span>
               <h3>MAcBOOK</h3>
               <a href="all_laptop.php" class="btn">mua ngay</a>
            </div>
         </div>

     
   </section>

</div>
<section>
   <a href="dtdd.php?sp=38" class="galaxya24">
      <img src="images/banner1.png" alt="">
   </a>
</section>



<section class="category">
   <div class="cuoituan">
      <img src="images/Cuoi-Tuan-1200x120.png" alt="">
   </div>
   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <?php
   
   $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 10 OFFSET 17"); 
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
   }else{
      echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="acer">
   <p class="tieude">ĐẠI TIỆC GAMING ACER</p>
   <div class="swiper myacer">
    <div class="swiper-wrapper">
      <div class="swiper-slide slide-top">
         <img src="images/acer1.png" alt="">
      </div>
      <div class="swiper-slide slide-top">
         <img src="images/acer2.png" alt="">
      </div>
      <div class="swiper-slide slide-top">
         <img src="images/acer3.png" alt="">
      </div>
      <div class="swiper-slide slide-top">
         <img src="images/acer4.png" alt="">
      </div>
      <div class="swiper-slide slide-top">
         <img src="images/acer5.png" alt="">
      </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <?php
   $acer = 'acer';
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$acer}%'"); 
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
   }else{
      echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
   }
   ?>

   </div>


   </div>

</section>

<section class="home-products">

   <h1 class="heading">sản phẩm mới nhất </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $nam = '2023';
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE details_10 LIKE '%{$nam}%'"); 
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
   }else{
      echo '<p class="empty">chưa có sản phẩm nào được thêm vào!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>


<section class="products" id="cuahang">

   <h1 class="heading">sản phẩm dành cho bạn</h1>


   <swiper-container class="mySwiper" init="false">

   <swiper-slide>
   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products`  LIMIT 25 OFFSET 0"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         $post_id = $fetch_product['id'];

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
   <form action="" method="post" class="box">
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
         <small><?= $km =  round((($fetch_product ['discount'] - $fetch_product ['price']) / $fetch_product ['price']) * 100) ; ?>%</small>
      </div>
      <p class="total-reviews"> <span><?= $average ?></span> <i class="fas fa-star">  <span> (<?= $total_reviews; ?>)</span></i>  </p>
      <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>
   </swiper-slide>
   <swiper-slide>
      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`  LIMIT 25 OFFSET 25"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
               $post_id = $fetch_product['id'];

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
         <form action="" method="post" class="box">
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
               <small><?= $km =  round((($fetch_product ['discount'] - $fetch_product ['price']) / $fetch_product ['price']) * 100) ; ?>%</small>
            </div>
            <p class="total-reviews"><span><?= $average ?></span> <i class="fas fa-star"> <span>(<?= $total_reviews; ?>)</span></i> </p>
            <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">không tìm thấy sản phẩm!</p>';
         }
         ?>

      </div>
   </swiper-slide>
   </swiper-container>
 
  


</section>







<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});
var swiper = new Swiper(".myacer", {
      slidesPerView: 3,
      spaceBetween: 30,
      freeMode: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
   const swiperEl = document.querySelector('swiper-container')

   const params = {
      injectStyles: [`
      .swiper-pagination-bullet {
         width: 20px;
         height: 20px;
         text-align: center;
         line-height: 20px;
         font-size: 12px;
         color: #000;
         opacity: 1;
         background: rgba(0, 0, 0, 0.2);
      }

      .swiper-pagination-bullet-active {
         color: #fff;
         background: #007aff;
      }
      `],
      pagination: {
         clickable: true,
         renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
         },
      },
      }

      Object.assign(swiperEl, params)

      swiperEl.initialize();
</script>
<?php include 'components/alers.php'; ?>
</body>
</html>