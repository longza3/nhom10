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

   if($user_id != ''){

      $id = create_unique_id();
      $title = $_POST['title'];
      $description = $_POST['description'];
      $rating = $_POST['rating'];

      $image_rv = $_FILES['image_rv']['name'];
      $image_size_rv = $_FILES['image_rv']['size'];
      $image_tmp_name_rv = $_FILES['image_rv']['tmp_name'];
      $image_folder_rv = '../kho_ảnh/'.$image_rv;

      $verify_review = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ? AND user_id = ?");
      $verify_review->execute([$get_id, $user_id]);

      if($verify_review->rowCount() > 0){
         $warning_msg[] = 'Bạn đã đánh giá sảm phẩm này rồi!';
      }else{
         $add_review = $conn->prepare("INSERT INTO `reviews`(id, post_id, user_id, rating, title, image_rv, description) VALUES(?,?,?,?,?,?,?)");
         $add_review->execute([$id, $get_id, $user_id, $rating, $title, $image_rv, $description]);
         $success_msg[] = 'Đã thêm đánh giá!';
      }



   }
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>thêm đánh giá</title>


   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>


<section class="account-form">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>gửi đánh giá của bạn</h3>
      <p class="placeholder">tiêu đề <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="nhập tiêu đề" class="box">
      <p class="placeholder">đánh giá sản phẩm</p>
      <textarea name="description" class="box" required placeholder="Nhập đánh giá" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">đánh giá sao <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1 sao</option>
         <option value="2">2 sao</option>
         <option value="3">3 sao</option>
         <option value="4">4 sao</option>
         <option value="5">5 sao</option>
      </select>
      <div class="inputBox">
            <span>Ảnh sản phẩm nếu có</span>
            <input type="file" name="image_rv" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
      <input type="submit" value="gửi đánh giá" name="submit" class="btn">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
         $select_products->execute([$get_id]);
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <a href="<?= $fetch_products['key_word']; ?>.php?sp=<?= $fetch_products['id']; ?>" class="option-btn">quay lại</a>
      <?php
         }
      ?>
   </form>

</section>














<?php include 'components/cuối_trang_user.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script src="js/script.js"></script>
<script>
      function quay_lai_trang_truoc(){
          history.back();
      }
</script>

<?php include 'components/alers.php'; ?>

</body>
</html>