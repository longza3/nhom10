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
   $success_msg[] = 'xoá đơn hàng thành công!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đặt hàng</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="menu_search" placeholder="tìm kiếm đơn hàng..." maxlength="100" class="box" onkeyup="searchfunc()" onclick="timkiemToggle()" required>
   </form>
</section>
<div class="oders-bg">
   <section class="shopping-cart products">


      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> id đơn</div>
            <div class="name"> Tên khách hàng</div>
            <div class="sdt"> Số điện thoại</div>
            <div class="ngay"> Ngày đặt đơn</div>
            <div class="sub-total" style="color: #fff;"> Tình trạng đơn hàng</div>
            <a href="#" style="color: #fff;">---</a>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_orders = $conn->prepare("SELECT * FROM `orders` ");
               $select_orders->execute();
               if($select_orders->rowCount() > 0){
                  while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_orders['id']; ?></div>
            <div class="name"> <?= $fetch_orders['name']; ?></div>
            <div class="sdt"><span><?= $fetch_orders['number']; ?></div>
            <div class="ngay"><?= $fetch_orders['date']; ?></div>
            <div class="sub-total"><span style="color: <?php if($fetch_orders['payment_status'] == 'chưa giải quyết'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span>  </div>
            <a href="chi_tiết_đơn_hàng.php?dh=<?= $fetch_orders['id']; ?>">chi tiết</a>
            <a href="đơn_hàng.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn <?= ($fetch_orders['payment_status'] != 'hoàn thành')?'':'disabled'; ?>" onclick="return confirm('bạn muốn hủy đơn đặt hàng này?');">Hủy</a>
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có đơn đặt hàng!</p>';
         }
         
         ?>
      </div>
   </section>
</div>


</section>











<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 
<script src="../js/admin_script.js"></script>
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