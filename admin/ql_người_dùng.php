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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="menu_search" placeholder="tìm kiếm người dùng..." maxlength="100" class="box" onkeyup="searchfunc()" onclick="timkiemToggle()" required>
   </form>
</section>
<div class="user-bg">
   <section class="shopping-cart products">

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id khách hàng</div>
            <div class="name"> Tên khách hàng</div>
            <div class="email"> Email</div>
            <div class="sdt"> Số điện thoại</div>
            <div class="ngay"> Ngày mở tài khoản</div>
            <div class="sub-total" style="color: #fff;">Quê quán</div>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_users = $conn->prepare("SELECT * FROM `users` ");
               $select_users->execute();
               if($select_users->rowCount() > 0){
                  while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_users['id']; ?></div>
            <div class="name"> <?= $fetch_users['name']; ?></div>
            <div class="email"> <?= $fetch_users['email']; ?></div>
            <div class="sdt"><span><?= $fetch_users['phone_number']; ?></div>
            <div class="ngay"><?= $fetch_users['date_time']; ?></div>
            <div class="sub-total"> <?= $fetch_users['flat'].' , '.$fetch_users['street'].' , '.$fetch_users['city']; ?></div>
            <a href="ql_người_dùng.php?delete=<?= $fetch_users['id']; ?>" class="delete-btn" onclick="return confirm('xóa tài khoản này?');">xóa</a>
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có khách hàng nào!</p>';
         }
         
         ?>
      </div>
   </section>
</div>












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