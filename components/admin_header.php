<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo"><span>Computer<i class="fa-brands fa-shopify"></i>Mark</span></a>

      <nav class="navbar">
      <?php

         $count_orders_items = $conn->prepare("SELECT * FROM `orders` ");
         $count_orders_items->execute();
         $total_orders_counts = $count_orders_items->rowCount();
      ?>
         <a href="../admin/dashboard.php"><span>Trang chủ</span></a>
         <a href="../admin/products.php"><span>Các sản phẩm</a>
         <a href="../admin/đơn_hàng.php"><span><i class="fa-solid fa-file-invoice-dollar"></i>(<?= $total_orders_counts; ?>)</span></a>
         <a href="../admin/Thống_kê.php"><span>Thống kê</span></a>
         <a href="../admin/admin_accounts.php"><span>Admins</span></a>
         <a href="../admin/ql_người_dùng.php"><span>Người dùng</span></a>
         <a href="../admin/reviews.php"><span>Review</span></a>
         <a href="../admin/messages.php"><span>Tin nhắn</span></a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">cập nhật hồ sơ admin</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn <?= ($fetch_profile['name'] == 'admin')?'':'disabled'; ?>" >Thêm NV</a>
            <a href="../admin/admin_login.php" class="option-btn">đăng nhập</a>
         </div>
         <div class="flex-btn">
            <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('bạn có muốn đăng xuất khỏi trang web?');">đăng xuất</a>
         </div>
         
      </div>

   </section>

   
</header>