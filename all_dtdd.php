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
   <title>cửa hàng</title>
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <a href="dtdd.php?sp=47"  class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
        <a href="dtdd.php?sp=46" class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
        <a href="dtdd.php?sp=48" class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
        <a href="dtdd.php?sp=49" class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
        <a href="dtdd.php?sp=50" class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
        <a href="dtdd.php?sp=51" class="swiper-slide">
          <img src="images/banner1.png" alt="">
        </a>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
    <div class="quick-link-dtdd">
      <div>
      <a href="loại_dtdd.php?loại=điện thoại iphone">
          <img src="images/r1.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại samsung">
          <img src="images/cpu.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại oppo">
          <img src="images/mb.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại xiaomi">
          <img src="images/oc.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại vivo">
          <img src="images/c2.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại realme">
          <img src="images/n1.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại nokia">
          <img src="images/tan.png" alt="">
        </a>
        <a href="loại_dtdd.php?loại=điện thoại itel">
          <img src="images/case.png" alt="">
        </a>
        
      </div>
    </div>

   <h1 class="heading">ALL SẢN PHẨM</h1>


   
                <div class="box-container">

                <?php
                    $loai = 'điện thoại';
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'"); 
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
                    <input type="hidden" name="import_price" value="<?= $fetch_product['import_price']; ?>">
                    <input type="hidden" name="key_word" value="<?= $fetch_product['key_word']; ?>">
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
                    echo '<p class="empty">không tìm thấy sản phẩm!</p>';
                }
                ?>

                </div>

   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <?php include 'components/alers.php'; ?>
   <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
  

</section>













<?php include 'components/cuối_trang_user.php'; ?>

<script src="js/script.js"></script>

</body>
</html>