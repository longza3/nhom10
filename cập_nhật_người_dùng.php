<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone_number = $_POST['phone_number'];
   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
      $success_msg[] = 'Tên người dùng được cập nhật!';
   }

   if(!empty($email)){
      $verify_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $verify_email->execute([$email]);
      if($verify_email->rowCount() > 0){
         $warning_msg[] = 'email đã tồn tại';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $success_msg[] = 'đã cập nhật email';
      }
   }
   if(!empty($phone_number)){
      $verify_phone_number = $conn->prepare("SELECT * FROM `users` WHERE phone_number = ?");
      $verify_phone_number->execute([$phone_number]);
      if($verify_phone_number->rowCount() > 0){
         $warning_msg[] = 'số điện thoại đã tồn tại';
      }else{
         $update_phone_number = $conn->prepare("UPDATE `users` SET phone_number = ? WHERE id = ?");
         $update_phone_number->execute([$phone_number, $user_id]);
         $success_msg[] = 'đã cập nhật số điện thoại';
      }
   }

   $image = $_FILES['image']['name'];
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/'.$rename;

  if(!empty($image)){
   if($image_size > 2000000){
      $error_msg[] = 'Kích thước hình ảnh quá lớn!';
   }else{
      $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
      $update_image->execute([$rename, $user_id]);
      move_uploaded_file($image_tmp_name, $image_folder);
      if($fetch_user['image'] != ''){
         unlink('images/'.$fetch_user['image']);
      }
      $success_msg[] = 'cập nhật ảnh thành công!';
   }
  }
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $new_pass = sha1($_POST['new_pass']);
   $cpass = sha1($_POST['cpass']);

   if($old_pass == $empty_pass){
      $m[] = 'vui lòng nhập mật khẩu cũ!';
   }elseif($old_pass != $prev_pass){
      $warning_msg[] = 'mật khẩu cũ không khớp!';
   }elseif($new_pass != $cpass){
      $warning_msg[] = 'mật khẩu mới không khớp!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $success_msg[] = 'Đã cập nhật mật khẩu thành công!';
      }
   }
   
}

if(isset($_POST['delete_image'])){

   $select_old_pic = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_old_pic->execute([$user_id]);
   $fetch_old_pic = $select_old_pic->fetch(PDO::FETCH_ASSOC);

   if($fetch_old_pic['image'] == ''){
      $warning_msg[] = 'Hình ảnh đã bị xóa!';
   }else{
      $update_old_pic = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
      $update_old_pic->execute(['', $user_id]);
      if($fetch_old_pic['image'] != ''){
         unlink('images/'.$fetch_old_pic['image']);
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
   <title>cập nhật thông tin</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<!-- update section starts  -->

<section class="account-form">

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <h3>cập nhật thông tin của bạn!</h3>
      <p class="placeholder">tên của bạn</p>
      <input type="text" name="name" maxlength="50" value="<?= $fetch_profile['name']; ?>" class="box">
      <p class="placeholder">số điện thoại</p>
      <input type="number" name="phone_number" maxlength="50"  value="<?= $fetch_profile['phone_number']; ?>" class="box">
      <p class="placeholder">email của bạn</p>
      <input type="email" name="email" maxlength="50" value="<?= $fetch_profile['email']; ?>" class="box">
      <p class="placeholder">mật khẩu hiện tại</p>
      <input type="password" name="old_pass" maxlength="50" placeholder="nhập mật khẩu của bạn" class="box" required>
      <p class="placeholder">mật khẩu mới</p>
      <input type="password" name="new_pass" maxlength="50" placeholder="nhập mật khẩu mới của bạn" class="box">
      <p class="placeholder">nhập lại mật khẩu mới</p>
      <input type="password" name="cpass" maxlength="50" placeholder="nhập lại mật khẩu mới của bạn" class="box">
      <?php if($fetch_profile['image'] != ''){ ?>
         <img src="images/<?= $fetch_profile['image']; ?>" alt="" class="image">
         <input type="submit" value="xóa ảnh" name="delete_image" class="delete-btn" onclick="return confirm('bạn muốn xóa avatar?');">
      <?php }; ?>
      <p class="placeholder">ảnh đại diện</p>
      <input type="file" name="image" class="box" accept="image/*">
      <input type="submit" value="cập nhật" name="submit" class="btn">
   </form>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>