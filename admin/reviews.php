<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};
// xóa tin nhắn
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   $success_msg[] = 'xóa thành công!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đánh giá</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="menu_search" placeholder="tìm kiếm review..." maxlength="100" class="box" onkeyup="searchfunc()" onclick="timkiemToggle()" required>
   </form>
</section>
<div class="review-bg">
   <section class="shopping-cart products">

      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id sản phẩm</div>
            <div class="name"> Id khách hàng</div>
            <div class="ngay"> Ngày đánh giá</div>
            <div class="vote"> Số sao</div>
            <div class="tieude"> Tiêu đề</div>
            <div class="binhluan"> Bình luận</div>
            <a href="#" style="color: #fff;">---</a>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_reviews = $conn->prepare("SELECT * FROM `reviews` ");
               $select_reviews->execute();
               if($select_reviews->rowCount() > 0){
                  while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_reviews['post_id']; ?></div>
            <div class="name"> <?= $fetch_reviews['user_id']; ?></div>
            <div class="ngay"><?= $fetch_reviews['date']; ?></div>
            <div class="vote"> <?= $fetch_reviews['rating']; ?><i class="fas fa-star" style="color: #FCF54C;"></i></div>
            <div class="tieude"><?= $fetch_reviews['title']; ?></div>
            <div class="binhluan"> <?= $fetch_reviews['description']; ?></div>
            <a href="chi_tiết_reviews.php?rv=<?= $fetch_reviews['id']; ?>">chi tiết</a>
            <a href="reviews.php?delete=<?= $fetch_reviews['id']; ?>" class="delete-btn" onclick="return confirm('xóa tin nhắn này?');">xóa</a>
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có review nào!</p>';
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