<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `reviews` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   $success_msg[] = 'xóa tài khoản thành công';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tài khoản người dùng</title>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="menu_search" placeholder="tìm ..." maxlength="100" class="box" onkeyup="searchfunc()" onclick="timkiemToggle()" required>
   </form>
</section>
<div class="statistical-bg">
   <section class="shopping-cart products">

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id khách hàng</div>
            <div class="name"> Tên khách hàng</div>
            <div class="email"> Địa chỉ</div>
            <div class="sdt"> Số điện thoại</div>
            <div class="ngay"> Ngày đặt</div>
            <div class="products">giá</div>
            <div class="products">Số lượng</div>
            <div class="products">Tổng</div>

            
         </form>
         <?php
             
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` ");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_details_order['user_id']; ?></div>
            <div class="name"> <?= $fetch_details_order['user_name']; ?></div>
            <div class="email"> <?= $fetch_details_order['address']; ?></div>
            <div class="sdt"><span><?= $fetch_details_order['phone_number']; ?></div>
            <div class="ngay"><?= $fetch_details_order['date']; ?></div>
            <div class="products"><?= $fetch_details_order['price']; ?></div>
            <div class="products"><?= $fetch_details_order['quantity']; ?></div>
            <div class="products"><?= $fetch_details_order['total']; ?></div>
         </form>
         <?php
          }
               }else{
                  echo '<p class="empty">chưa có khách hàng nào!</p>';
               }
         ?>
      </div>
      </form>
<!-- thống kê điện thoại -->
         <?php
               $tongdtdd = 0;
               $sl = 0;
               $dtdd = 'dtdd';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$dtdd}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){        
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongdtdd += $sl;
          }
               }
         ?>
<!-- thống kê laptop -->
         <?php
               $tonglaptop = 0;
               $sl = 0;
               $laptop = 'laptop';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$laptop}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){
                     
                     
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tonglaptop += $sl;
          }
               }
         ?>
<!-- thống kê chuột -->
         <?php
               $tongchuot = 0;
               $sl = 0;
               $chuot = 'chuot';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$chuot}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){
                     
                     
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
             <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongchuot += $sl;
          }
               }else{
                  echo '<p class="empty">chưa có khách hàng nào!</p>';
               }
         ?>
<!-- thống kê bàn phím-->
         <?php
               $tongbanphim = 0;
               $sl = 0;
               $banphim = 'banphim';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$banphim}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){           
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongbanphim += $sl;
          }
               }
         ?>
<!-- thống kê loa -->
         <?php
               $tongloa_bluetooth = 0;
               $sl = 0;
               $loa_bluetooth = 'loa_bluetooth';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$loa_bluetooth}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){      
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongloa_bluetooth += $sl;
          }
               }
         ?>
<!-- thống kê cáp điện thoại -->
         <?php
               $tongcapdienthoai = 0;
               $sl = 0;
               $capdienthoai = 'cap-dien-thoai';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$capdienthoai}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){        
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongcapdienthoai += $sl;
          }
               }
         ?>
<!-- thống kê sạc điện thoại -->
         <?php
               $tongsacdienthoai = 0;
               $sl = 0;
               $sacdienthoai = 'sac-dien-thoai';
               $select_details_order = $conn->prepare("SELECT * FROM `details_order` WHERE key_word LIKE '%{$sacdienthoai}%'");
               $select_details_order->execute();
               if($select_details_order->rowCount() > 0){
                  while($fetch_details_order = $select_details_order->fetch(PDO::FETCH_ASSOC)){ 
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <input type="hidden" name="cart_id" value="<?= $sl = 1 * $fetch_details_order['quantity']; ?>" >
         </form>
         <?php
            $tongsacdienthoai += $sl;
          }
               }
         ?>
   
   </section>
</div>
<section style="background-color: #fff;margin-bottom: 100px;">
<h1>Biểu đồ thống kê</h1>
<div style="width: 1000px;">
  <canvas id="myChart"></canvas>
</div>
</section>










<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 
<script src="../js/admin_script.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Linh kiện máy tính', 'laptop', 'loa Bluetooth', 'chuột', 'bàn phím', 'sạc', 'cáp'],
      datasets: [{
        label: 'sản phẩm',
        data: [<?= $tongdtdd; ?>, <?= $tonglaptop; ?>, <?= $tongloa_bluetooth; ?>, <?= $tongchuot; ?>, <?= $tongbanphim; ?>, <?= $tongsacdienthoai; ?>, <?= $tongcapdienthoai; ?>],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',  
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(89, 162, 235, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>

<script>
   function searchfunc(){
    let menusearch=document.querySelector('#menu_search');
    let menuitem=Array.from(document.querySelectorAll('#menu_item'));
    console.log("menu item",menuitem);
    let value  = menusearch.value
    const convertToLowerCase  = value.toLowerCase()
    menuitem.forEach(function(el){

        let text=el.innerText;
        if(text.toLowerCase().indexOf(convertToLowerCase)>-1)
        el.style.display=""
        else el.style.display="none"
    })
}
  searchfunc()
</script>

   
</body>
</html>