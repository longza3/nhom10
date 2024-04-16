<?php

include 'components/connect.php';


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:cửa_hàng.php');
}

if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $description = $_POST['description'];
   $rating = $_POST['rating'];

   $update_review = $conn->prepare("UPDATE `reviews` SET rating = ?, title = ?, description = ? WHERE id = ?");
   $update_review->execute([$rating, $title, $description, $get_id]);


   $select_review = $conn->prepare("SELECT * FROM `reviews` WHERE id = ? LIMIT 1");
   $select_review->execute([$get_id]);
   $fetch_review = $select_review->fetch(PDO::FETCH_ASSOC);

   
   $image_rv = $_FILES['image_rv']['name'];
   $ext = pathinfo($image_rv, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_rv_size = $_FILES['image_rv']['size'];
   $image_rv_tmp_name = $_FILES['image_rv']['tmp_name'];
   $image_rv_folder = 'kho_ảnh/'.$rename;

  if(!empty($image_rv)){
   if($image_rv_size > 2000000){
      $error_msg[] = 'Kích thước hình ảnh quá lớn!';
   }else{
      $update_image_rv = $conn->prepare("UPDATE `reviews` SET image_rv = ? WHERE id = ?");
      $update_image_rv->execute([$rename, $get_id]);
      move_uploaded_file($image_rv_tmp_name, $image_rv_folder);
      if($fetch_review['image_rv'] != ''){
         unlink('kho_ảnh/'.$fetch_review['image_rv']);
      }
      $success_msg[] = 'cập nhật ảnh thành công!';
   }
  }
      $success_msg[] = 'Đánh giá được cập nhật!';

}
if(isset($_POST['delete_image'])){

   $select_old_pic = $conn->prepare("SELECT * FROM `reviews` WHERE id = ? LIMIT 1");
   $select_old_pic->execute([$get_id]);
   $fetch_old_pic = $select_old_pic->fetch(PDO::FETCH_ASSOC);

   if($fetch_old_pic['image_rv'] == ''){
      $warning_msg[] = 'Hình ảnh đã bị xóa!';
   }else{
      $update_old_pic = $conn->prepare("UPDATE `reviews` SET image_rv = ? WHERE id = ?");
      $update_old_pic->execute(['', $get_id]);
      if($fetch_old_pic['image_rv'] != ''){
         unlink('kho_ảnh/'.$fetch_old_pic['image_rv']);
      }
      $success_msg[] = 'xóa ảnh thành công!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cập nhật đánh giá</title>


   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>


<section class="account-form">

   <?php
      $idsp = 0;
      $select_review = $conn->prepare("SELECT * FROM `reviews` WHERE id = ? LIMIT 1");
      $select_review->execute([$get_id]);
      if($select_review->rowCount() > 0){
         while($fetch_review = $select_review->fetch(PDO::FETCH_ASSOC)){
            $idsp = $fetch_review['post_id'];
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>sửa đánh giá của bạn</h3>
      <input type="hidden" name="old_image_rv" value="<?=  $fetch_review['image_rv']; ?>">
      <p class="placeholder">tiêu đề  <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="nhập tiêu đề" class="box" value="<?= $fetch_review['title']; ?>">
      <p class="placeholder">đánh giá sản phẩm</p>
      <textarea name="description" class="box" placeholder="Nhập đánh giá" maxlength="1000" cols="30" rows="10"><?= $fetch_review['description']; ?></textarea>
      <p class="placeholder">đánh giá sao <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="<?= $fetch_review['rating']; ?>"><?= $fetch_review['rating']; ?></option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <?php if($fetch_review['image_rv'] != ''){ ?>
         <img src="kho_ảnh/<?= $fetch_review['image_rv']; ?>" alt="" class="image">
         <input type="submit" value="xóa ảnh" name="delete_image" class="delete-btn" onclick="return confirm('bạn muốn xóa ảnh?');">
      <?php }; ?>
      <p class="placeholder">ảnh review</p>
      <input type="file" name="image_rv" class="box" accept="image/*">
      <input type="submit" value="cập nhật đánh giá" name="submit" class="btn">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_products->execute([$idsp]);
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <a href="<?= $fetch_products['key_word']; ?>.php?sp=<?= $fetch_products['id']; ?>" class="option-btn">quay lại</a>
      
   </form>
   <?php
            }
         }
      }else{
         echo '<p class="empty">something went wrong!</p>';
      }
   ?>

</section>
















<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>