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
$rv = $_GET['rv'];
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

<section class="contacts">

<h1 class="heading">chi tiết đánh giá</h1>

<div class="box-container">

   <?php
      $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE `id` = ?");
      $select_reviews->execute([$rv]);
      if($select_reviews->rowCount() > 0){
         while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Id đánh giá : <span><?= $fetch_reviews['id']; ?></span></p>
      <p> Id người đánh giá : <span><?= $fetch_reviews['user_id']; ?></span></p>
      <p> Id sản phẩm : <span><?= $fetch_reviews['post_id']; ?></span></p>
      <p> Số sao : <span><?= $fetch_reviews['rating']; ?></span> <i class="fas fa-star" style="color: #FCF54C;"></i></p>
      <p> Tiêu đề : <span><?= $fetch_reviews['title']; ?></span></p>
      <p> Bình luận : <span><?= $fetch_reviews['description']; ?></span></p>
      <p> Ngày đánh giá : <span><?= $fetch_reviews['date']; ?></span></p>
      <a href="reviews.php?delete=<?= $fetch_reviews['id']; ?>" onclick="return confirm('bạn muốn xóa đánh giá này?');" class="delete-btn">xóa</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Không có review</p>';
      }
   ?>

</div>

</section>











<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?>  

<script src="../js/admin_script.js"></script>
   
</body>
</html>