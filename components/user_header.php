

<header class="header">

   <section class="flex">

      <a href="trang_chủ.php" class="logo">Computer<span><i class="fa-brands fa-shopify"></i></span>Mark</a>
      <nav class="navbar">
         <a href="trang_chủ.php"><i class="fa-solid fa-house"></i> Trang chủ </a>
         <a href="all_dtdd.php"><i class="fa-solid fa-mobile-button"></i> linh kiện</a>
         <a href="all_cáp_điện_thoại.php"><i class="fa-solid fa-calendar-plus"></i> Capture Card</a>
         <a href="all_sạc_điện_thoại.php"><i class="fa-solid fa-charging-station"></i> Sạc</a>
         <a href="all_laptop.php"><i class="fa-solid fa-laptop"></i> laptop</a>
         <a href="all_chuột.php"><i class="fa-solid fa-computer-mouse"></i> Chuột</a>
         <a href="all_loa_bluetooth.php"><i class="fa-brands fa-bluetooth"></i> Loa </a>
         <!-- <a href="phụ_kiện.php"><i class="fa-solid fa-headphones"></i> phụ kiện</a> -->
         <a href="all_bàn_phím.php"><i class="fa-regular fa-keyboard"></i> Bàn phím</a>
         <a href="giới_thiệu.php"><i class="fa-solid fa-circle-info"></i> Giới thiệu</a>
         <a href="đơn_hàng.php"><i class="fa-solid fa-cart-plus"></i> Đơn hàng</a>
         <a href="liên_hệ.php"><i class="fa-solid fa-address-book"></i> Liên hệ</a>
      </nav>

      <div class="icons">
         <?php

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="tìm_kiếm_SP.php"><i class="fas fa-search"></i></a>
         <a href="giỏ_hàng.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
        
         <p>
         <?php if($fetch_profile['image'] != ''){ ?>
            <img src="images/<?= $fetch_profile['image']; ?>" alt="" class="image">
         <?php }; ?> 
         </p>
         <p>
            <?= $fetch_profile["name"]; ?>
         </p>
         <a href="cập_nhật_người_dùng.php" class="btn">cập nhật hồ sơ</a>
         <div class="flex-btn">
            <a href="register.php" class="option-btn">đăng ký</a>
            <a href="login.php" class="option-btn">đăng nhập</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('bạn muốn đăng xuất khỏi trang web?');">đăng xuất</a> 
         <?php
            }else{
         ?>
         <p>Vui lòng đăng nhập hoặc đăng ký trước!</p>
         <div class="flex-btn">
            <a href="register.php" class="option-btn">đăng ký</a>
            <a href="login.php" class="option-btn">đăng nhập</a>
         </div>
         <?php
            }
            
         ?>      
         
         
      </div>

   </section>

</header>